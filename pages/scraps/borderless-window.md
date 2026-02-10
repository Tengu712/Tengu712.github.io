---
title: Win32APIボーダーレスウィンドウ
topic: windowsapi
tags: []
index: false
---

Win32APIでボーダーレスウィンドウを作る場合、`WM_NCCALCSIZE`メッセージでクライアントサイズをウィンドウサイズまで拡張する。

デフォルトプロシージャは`WM_NCCALCSIZE`を受け取ると、ウィンドウサイズからクライアントサイズへ縮小することで、クライアントサイズを確定させる。
それを阻止することでクライアントサイズをウィンドウサイズに保ち、結果的にウィンドウ全体がクライアント領域となる。
という算段。

```cpp
#include <Windows.h>

LRESULT CALLBACK WndProc(HWND hWnd, UINT msg, WPARAM wParam, LPARAM lParam) {
	switch (msg) {
	case WM_DESTROY:
		PostQuitMessage(0);
		return 0;
	case WM_NCCALCSIZE:
		return 0;
	}
	return DefWindowProcW(hWnd, msg, wParam, lParam);
}

int main() {
	const auto hInst = GetModuleHandle(NULL);

	WNDCLASSEXW wc = {};
	wc.style = CS_DBLCLKS;
	wc.cbSize = sizeof(WNDCLASSEXW);
	wc.lpfnWndProc = WndProc;
	wc.hInstance = hInst;
	wc.lpszClassName = L"TestClass";
	wc.hbrBackground = (HBRUSH)GetStockObject(BLACK_BRUSH);
	RegisterClassExW(&wc);

	auto hWnd = CreateWindowExW(
		0,
		L"TestClass",
		L"Test",
		WS_OVERLAPPEDWINDOW | WS_VISIBLE,
		100,
		100,
		640,
		480,
		NULL,
		NULL,
		hInst,
		NULL
	);

	MSG msg;
	while (true) {
		if (PeekMessageW(&msg, nullptr, 0, 0, PM_REMOVE) == 0) {
			// Dead time
			Sleep(16);
			continue;
		}
		if (msg.message == WM_QUIT) {
			return 0;
		}
		TranslateMessage(&msg);
		DispatchMessageW(&msg);
	}
}
```

ボーダーレスにすることで、独自のタイトルバーを作成できる。
Electronは`new BrowserWindow()`に対し`frame: fasle`を指定すると、上記の方法と概ね同じ方法でボーダーレスウィンドウを生成する。
DiscordなりVivaldiなりのElectron製アプリではこうしてウィンドウを作成し、独自のタイトルバーを作っている。
