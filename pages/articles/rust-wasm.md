---
title: "Rust WASMを試す"
genre: "prog"
tags: ["rust", "wasm"]
date: "2024/03/04"
---

## 概要

WASM(WebAssembly)をRustで試す。
ただし、wasm-bindgen及びwasm-packを使わない。

「試す」という言葉の通り、本記事は解説記事ではない。
なんといっても、私はまだWASMを扱って二日目である。
ヤバいことをやっている可能性は十二分にあるが、今のところの理解を認める。



## 簡単なプログラム

本章では、難しいことをしないプログラムを考える。
例として、二つの数値の加算をするだけのプログラムを挙げる。
まず、Rustのサンプルコードは以下になる。

```rs
// lib.rs
#[no_mangle]
pub extern "C" fn add(x: i32, y: i32) -> i32 {
    x + y
}
```

以下のコマンドでwasmファイルを生成する。
重要なのはcrate-typeとtargetである。
他のオプションはwasmファイルを肥大化させないための最適化である。

```
rustc
  --crate-type=cdylib
  --target=wasm32-unknown-unknown
  -C debug-assertions=false
  -C opt-level=3
  -C codegen-units=1
  -C lto=true
  lib.rs
```

wasmファイルを生成したら、以下のようなJavaScriptから利用できる。
WebAssembly.instantiate関数によりwasmファイルのバイナリデータからインスタンス(WebAssembly.Instance)を作成する。
WebAssembly.Instance.exportsにはRust側の関数が格納されている。

```js
// index.js
const wasmInstance = await fetch("./lib.wasm")
  .then((response) => response.arrayBuffer())
  .then((bytes) => WebAssembly.instantiate(bytes))
  .then((wasm) => wasm.instance)

const result = wasmInstance.exports.add(1, 2)
console.log(result) // 3
```



## JavaScript側の関数を用いる

本章では、Rust側からJavaScript側の関数を利用するプログラムを考える。
例として、JavaScript側で定義した乗算関数を用いるプログラムを挙げる。
まず、Rustのサンプルコードは以下になる。  

```rs
// lib.rs
extern "C" {
    pub fn mul(x: i32, y: i32) -> i32;
}

#[no_mangle]
pub extern "C" fn double(x: i32) -> i32 {
  unsafe { mul(x, 2) }
}
```

JavaScriptのコードは以下のようになる。
WebAssembly.instantiate関数でWASMインスタンスを作成するとき、その第二引数にRust側へ渡す関数を指定する必要がある。  

```js
// index.js
const imports = {
  env: {
    mul: function(x, y) { return x * y },
  },
}
const wasmInstance = await fetch("./lib.wasm")
  .then((response) => response.arrayBuffer())
  .then((bytes) => WebAssembly.instantiate(bytes, imports))
  .then((wasm) => wasm.instance)

const result = wasmInstance.exports.double(3)
console.log(result) // 6
```



## Rust側のメモリを読み取る

本章では、JavaScript側からRust側のメモリを読み取るプログラムを考える。
例として、Rust側で作成した構造体をJavaScript側で利用するプログラムを挙げる。
ただし、構造体のメソッドについては無視する。
  
WASMは数値の受渡ししかできない。
当然ながら、Rust側から複数の情報を一挙に返すことはできない。
従って、Rust側でメモリをアロケートし、そこへ情報を書き込み、そのポインタを返し、JavaScript側から読み取る。
以下はRust側のサンプルコードである。

```rs
// lib.rs
#[repr(C)]
pub struct SampleObject {
    pub x: u32;
    pub y: u32;
}

#[no_mangle]
pub extern "C" fn create_sample_object() -> *const SampleObject {
    let sample_object = Box::new(SampleObject { x: 1, y: 2 });
    Box::leak(sample_object)
}

#[no_mangle]
pub extern "C" fn free_sample_object(sample_object: *const SampleObject) {
    let _ = unsafe { Box::from_raw(sample_object) };
}
```

JavaScriptのコードは以下のようになる。
以下の通り、WebAssembly.Instance.exportsにはmemory.bufferというメモリ情報が格納されている。
ここからお好みにメモリを読み取ることで、Rustとオブジェクトを共有できる。

```js
// index.js
function getSampleObjectAt(wasmInstance, pointer) {
  const array = new Uint32Array(wasmInstance.exports.memory.buffer, pointer, 2)
  return {
    x: array[0],
    y: array[1],
  }
}

const pointer = wasmInstance.exports.create_sample_object()
const sampleObject = getSampleObjectAt(wasmInstance, pointer)
console.log(sampleObject.x) // 1
console.log(sampleObject.y) // 2
wasmInstance.exports.free_sample_object(pointer)
```



## JavaScript側からオブジェクトを渡す

本章では、JavaScript側からRust側へオブジェクトを渡すプログラムを考える。
例として、JavaScript側からRust側へ文字列を渡すプログラムを挙げる。

愚直に以下のプログラムを組むと、out of rangeが発生する。
何故なら、WASM側のメモリ領域とJavaScript側のメモリ領域が異なるからである。

```rs
// lib.rs
use std::ffi::*;

#[no_mangle]
pub extern "C" fn get_len_of_string(s_pointer: *const c_char) -> u32 {
    let s_pointer = s_pointer as *mut c_char;
    let s_cstr = unsafe { CStr::from_ptr(s_pointer) };
    let s_str = s_cstr.to_str().unwrap();
    let s = String::from(s_str);
    s.len() as u32
}
```

```js
// index.js
const result = wasmInstance.exports.get_len_of_string("foo") // exception
console.log(result)
```

この問題を解決するために、JavaScript側からWASM側のメモリを確保する。
WASM側のメモリを確保するために、Rust側にメモリ確保の関数を定義する。

```rs
// lib.rs
use std::ffi::*;

#[no_mangle]
pub extern "C" fn allocate(size: u32) -> *const u8 {
    let size = size as usize;
    let buffer: Vec<u8> = Vec::with_capacity(size);
    buffer.leak().as_ptr()
}

#[no_mangle]
pub extern "C" fn deallocate(pointer: *const u8, size: u32) {
    unsafe { Vec::from_raw_parts(pointer as *mut u8, size as usize, size as usize) };
}

#[no_mangle]
pub extern "C" fn get_len_of_string(s_pointer: *const c_char) -> u32 {
    let s_pointer = s_pointer as *mut c_char;
    let s_cstr = unsafe { CStr::from_ptr(s_pointer) };
    let s_str = s_cstr.to_str().unwrap();
    let s = String::from(s_str);
    s.len() as u32
}
```

```js
// index.js
function copyUint8ArrayTo(wasmInstance, pointer, source, length) {
  const destination = new Uint8Array(wasmInstance.exports.memory.buffer, pointer, length)
  destination.set(source)
}

const text = new TextEncoder().encode("foo")
const pointer = wasmInstance.exports.allocate(text.length)
copyUint8ArrayTo(wasmInstance, pointer, text, text.length)
const result = wasmInstance.exports.get_len_of_string("foo")
console.log(result) // 3
wasmInstance.exports.deallocate(pointer, text.length)
```



## 結論

よっぽどWASM主体で組めるプログラムでない限りは、使わないかなあ。
