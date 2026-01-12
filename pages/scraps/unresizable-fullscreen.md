---
title: 非resizableなNSWindowのフルスクリーン時コンテントサイズ
topic: macos
tags: ["swift"]
index: false
---

Cocoaフレームワークにおいて、非resizableなウィンドウは次のように作る:

```swift
let window = NSWindow(
  contentRect: NSRect(x: 0, y: 0, width: Int(width), height: Int(height)),
  styleMask: [.titled, .closable, .miniaturizable],
  backing: .buffered,
  defer: false
)
```

このウィンドウは次のようにフルスクリーン状態をトグルできる:

```swift
window.toggleFullScreen(nil)
```

しかし、何もしないとフルスクリーンになってもコンテントサイズが維持される。
例えば、640x480でウィンドウを作成し、コンテントの背景を赤に塗り潰し、フルスクリーンにした場合、フルスクリーンにはなるものの、画面中央に640x480の赤い四角形が表示されることになる。
これを回避するためには次のデリゲートを実装する:

```swift
class WindowDelegate: NSWindowDelegate {
  // フルスクリーン時のコンテントサイズを指定するメソッド
  func window(_ window: NSWindow, willUseFullScreenContentSize proposedSize: NSSize) -> NSSize {
    // 画面サイズを返す
    if let screen = window.screen {
      return screen.frame.size
    }
    // 画面が取得できないなら仕方ない
    return proposedSize
  }
}

window.delegate = WindowDelegate()
```

上記メソッドにより、フルスクリーン時のコンテントサイズが画面サイズと同じになり、上記の例においては画面全体が赤くなる。
しかし、フルスクリーンを解除すると、このときもまたコンテントサイズが維持される。
そのため、期待より随分と大きいサイズのウィンドウに戻ってしまう。
これを回避するためには次のようにフルスクリーン解除時にウィンドウフレームを指定する:

```swift
class WindowDelegate: NSWindowDelegate {
  var windowFrame: NSRect?

  func window(_ window: NSWindow, willUseFullScreenContentSize proposedSize: NSSize) -> NSSize {
    /* ... */
  }

  // フルスクリーンに入る直前に呼ばれるメソッド
  func windowWillEnterFullScreen(_ notification: Notification) {
    guard let window = notification.object as? NSWindow else {
      return
    }
    // フルスクリーンに入る前にウィンドウフレームを保存しておく
    windowFrame = window.frame
  }

  // フルスクリーンから出る直前に呼ばれるメソッド
  func windowWillExitFullScreen(_ notification: Notification) {
    guard
      let window = notification.object as? NSWindow,
      let windowFrame = windowFrame
    else {
      return
    }
    // ウィンドウフレームをフルスクリーンに入る直前のものに即時的に変更する
    // ウィンドウサイズ変化アニメーションは行われる
    window.setFrame(windowFrame, display: false)
  }
}
```
