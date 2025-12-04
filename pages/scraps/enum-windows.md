---
title: "ウィンドウアプリケーションの列挙"
topic: "windowsapi"
tags: []
index: false
---

```c
#include <windows.h>
#include <dwmapi.h>
#include <stdio.h>
#include <string.h>

BOOL CALLBACK EnumWindowsProc(HWND hWnd, LPARAM lp) {
    // skip invisible window
    if (!IsWindowVisible(hWnd)) {
        return TRUE;
    }
    // skip nameless window
    CHAR title[256] = {};
    int res_gwt = GetWindowTextA(hWnd, (LPSTR)title, 256);
    if (!res_gwt || strlen(title) == 0) {
        return TRUE;
    }
    // skip child window
    DWORD styles = (DWORD)GetWindowLongPtrA(hWnd, GWL_STYLE);
    if (styles &amp; WS_CHILD) {
        return TRUE;
    }
    // skip cloaked window
    DWORD cloaked;
    HRESULT res_dgwa = DwmGetWindowAttribute(hWnd, DWMWA_CLOAKED, &amp;cloaked, sizeof(DWORD));
    if (res_dgwa != S_OK || cloaked) {
        return TRUE;
    }
    // skip Program Manager
    CHAR classname[256] = {};
    int res_gcn = GetClassName(hWnd, (LPSTR)classname, 256);
    if (!res_gcn || strcmp(classname, "Progman") == 0) {
        return TRUE;
    }
    // finish
    printf("%s\n", title);
    return TRUE;
}

int main() {
    EnumWindows(EnumWindowsProc, (LPARAM)NULL);
    return 0;
}
```
