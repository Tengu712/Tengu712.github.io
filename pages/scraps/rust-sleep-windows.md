---
title: RustのsleepはWindowsでも高精度
topic: rust
tags: ["windowsapi"]
index: false
---

Win32APIの`Sleep`関数の待機時間はシステムクロックに依存する。
x86プロセッサでのシステムクロックは標準で約15msである。
従って、`Sleep(1)`は0から15ms、`Sleep(16)`は15から30ms程度の待機となる。
この精度を上げるために公式からも`timeBeginPeriod`関数と`timeEndPeriod`関数が使えることが言及されている。
しかし、同時にこれら関数はシステムグローバルに影響を及ぼし、ひいてはスケジューラや電力使用量に影響を及ぼすことも言及されている[1, 2]。

一方で、Win32APIには`CreateWaitableTimerExW`関数というタイマーを作成する関数が用意されている。
`CREATE_WAITABLE_TIMER_HIGH_RESOLUTION`フラグを用いると、そのタイマーの精度を数ms程度に高めることができる。
このタイマーのハンドルを`SetWaitableTimer`関数でセットすると、`WaitForSingleObject`関数でタイマーに指定した精度でスレッドを待機できる。
このタイマーおよび設定は`timeBeginPeriod`関数とは異なりシステムグローバルに影響を及ぼさない[3]。

Rustの`std::thread::sleep`関数は内部的に上記の`CreateWaitableTimerExW`関数で作成したタイマーを用いているため高精度である。
`sleep`関数の内部実装は次のようになっている[4]:

```rs
pub fn sleep(dur: Duration) {
    fn high_precision_sleep(dur: Duration) -> Result<(), ()> {
        let timer = WaitableTimer::high_resolution()?;
        timer.set(dur)?;
        timer.wait()
    }
    // Attempt to use high-precision sleep (Windows 10, version 1803+).
    // On error fallback to the standard `Sleep` function.
    // Also preserves the zero duration behavior of `Sleep`.
    if dur.is_zero() || high_precision_sleep(dur).is_err() {
        unsafe { c::Sleep(dur2timeout(dur)) }
    }
}
```

与えられた待機時間が0秒でないなら`high_precision_sleep`関数を試み、Win32APIの`Sleep`関数のフォールバックしている。
また、`WaitableTimer`は次のようになっている[5]:

```rs
pub(crate) struct WaitableTimer {
    handle: c::HANDLE,
}
impl WaitableTimer {
    /// Creates a high-resolution timer. Will fail before Windows 10, version 1803.
    pub fn high_resolution() -> Result<Self, ()> {
        let handle = unsafe {
            c::CreateWaitableTimerExW(
                null(),
                null(),
                c::CREATE_WAITABLE_TIMER_HIGH_RESOLUTION,
                c::TIMER_ALL_ACCESS,
            )
        };
        if !handle.is_null() { Ok(Self { handle }) } else { Err(()) }
    }
    pub fn set(&self, duration: Duration) -> Result<(), ()> {
        // Convert the Duration to a format similar to FILETIME.
        // Negative values are relative times whereas positive values are absolute.
        // Therefore we negate the relative duration.
        let time = checked_dur2intervals(&duration).ok_or(())?.neg();
        let result = unsafe { c::SetWaitableTimer(self.handle, &time, 0, None, null(), c::FALSE) };
        if result != 0 { Ok(()) } else { Err(()) }
    }
    pub fn wait(&self) -> Result<(), ()> {
        let result = unsafe { c::WaitForSingleObject(self.handle, c::INFINITE) };
        if result != c::WAIT_FAILED { Ok(()) } else { Err(()) }
    }
}
impl Drop for WaitableTimer {
    fn drop(&mut self) {
        unsafe { c::CloseHandle(self.handle) };
    }
}
```

該当PRは[#116461](https://github.com/rust-lang/rust/pull/116461)であり、1.75.0の追加機能である。

参考文献:

- [[1] Microsoft Learn: Sleep function (synchapi.h)](https://learn.microsoft.com/en-us/windows/win32/api/synchapi/nf-synchapi-sleep)
- [[2] Microsoft Learn: High-resolution timers](https://learn.microsoft.com/en-us/windows-hardware/drivers/kernel/high-resolution-timers)
- [[3] Microsoft Learn: CreateWaitableTimerExW function (synchapi.h)](https://learn.microsoft.com/en-us/windows/win32/api/synchapi/nf-synchapi-createwaitabletimerexw)
- [[4] GitHub: windows.rs](https://github.com/rust-lang/rust/blob/da476f1942868cdf94ed88b01ea31170cfe95047/library/std/src/sys/thread/windows.rs#L117-L129)
- [[5] GitHub: time.rs](https://github.com/rust-lang/rust/blob/da476f1942868cdf94ed88b01ea31170cfe95047/library/std/src/sys/pal/windows/time.rs#L241-L274)
