---
title: オーバーレイウィンドウ
topic: windowsapi
tags: ["c++"]
index: false
---

次は画面上の左上原点座標(100, 100)に幅高(300, 300)の赤色の円を表示する例:

```cpp
#include <Windows.h>

#pragma comment(lib, "user32")
#pragma comment(lib, "gdi32")

LPCWSTR WINDOW_CLASS_NAME = L"OverlayClass";
LPCWSTR WINDOW_TITLE      = L"Overlay";
DWORD EX_WINDOW_STYLE = WS_EX_TOPMOST // the window appears above all other windows
	| WS_EX_LAYERED                   // the window is transparentable
	| WS_EX_TRANSPARENT               // the window passes clicks through to the background
	| WS_EX_TOOLWINDOW                // the window doesn't appear in both window switcher and task bar
	| WS_EX_NOACTIVATE;               // the window can't be focused with click
DWORD WINDOW_STYLE    = WS_POPUP;     // the window doesn't have any frame

void showErrorMessage(LPCWSTR text) {
	MessageBoxW(nullptr, text, L"Error", MB_OK | MB_ICONERROR);
}

void paint(HWND window) {
	PAINTSTRUCT ps;
	const HDC hdc = BeginPaint(window, &ps);
	const HBRUSH br = CreateSolidBrush(RGB(255, 0, 0));
	SelectObject(hdc, br);
	Ellipse(hdc, 100, 100, 300, 300);
	DeleteObject(br);
	EndPaint(window, &ps);
}

LRESULT CALLBACK windowProc(HWND window, UINT msg, WPARAM wparam, LPARAM lparam) {
	switch (msg) {
	case WM_DESTROY:
		PostQuitMessage(0);
		return 0;
	case WM_PAINT:
		paint(window);
		return 0;
	default:
		return DefWindowProc(window, msg, wparam, lparam);
	}
}

bool registerWindowClass(HINSTANCE inst) {
	WNDCLASSEXW windowClass;
	windowClass.cbSize = sizeof(WNDCLASSEXW);

	if (GetClassInfoExW(inst, WINDOW_CLASS_NAME, &windowClass)) {
		return true;
	}

	windowClass.style         = CS_CLASSDC;
	windowClass.lpfnWndProc   = windowProc;
	windowClass.cbClsExtra    = 0;
	windowClass.cbWndExtra    = 0;
	windowClass.hInstance     = inst;
	windowClass.hIcon         = nullptr;
	windowClass.hCursor       = nullptr;
	windowClass.hbrBackground = nullptr;
	windowClass.lpszMenuName  = nullptr;
	windowClass.lpszClassName = WINDOW_CLASS_NAME;
	windowClass.hIconSm       = nullptr;
	if (RegisterClassExW(&windowClass) == 0) {
		return false;
	}
	return true;
}

int WINAPI WinMain(HINSTANCE inst, HINSTANCE, LPSTR, int) {
	if (!registerWindowClass(inst)) {
		showErrorMessage(L"Failed to register the window class");
		return 1;
	}

	const int x = GetSystemMetrics(SM_XVIRTUALSCREEN); // screen's left edge
	const int y = GetSystemMetrics(SM_YVIRTUALSCREEN); // screen's top edge
	const int w = GetSystemMetrics(SM_CXVIRTUALSCREEN); // screen's width
	const int h = GetSystemMetrics(SM_CYVIRTUALSCREEN); // screen's height

	const HWND window = CreateWindowExW(
		EX_WINDOW_STYLE,
		WINDOW_CLASS_NAME,
		WINDOW_TITLE,
		WINDOW_STYLE,
		x,
		y,
		w,
		h,
		nullptr,
		nullptr,
		inst,
		nullptr
	);
	if (!window) {
		showErrorMessage(L"Failed to create the window");
		return 1;
	}

	SetLayeredWindowAttributes(window, RGB(0, 0, 0), 0, LWA_COLORKEY);
	ShowWindow(window, SW_SHOW);

	MSG msg;
	while (GetMessage(&msg, nullptr, 0, 0)) {
		TranslateMessage(&msg);
		DispatchMessage(&msg);
	}
	return 0;
}
```
