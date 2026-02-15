---
title: "ClackでWebサーバを立てる"
topic: "commonlisp"
tags: []
index: false
---

Roswellをインストール・セットアップし、REPLを開く。
以下、brewコマンドが使える場合。
`ros setup`での初期化時にSBCLとQuicklispがインストールされる。

```
$ brew install roswell
$ ros setup
$ ros run
*
```

ライブラリをインストールし、clackサーバを立てる。
以下、プロンプトを書かないが、REPLで順次実行するものとする。
localhost:5000にアクセスすると"Hello, Clack!"が返ってくる。

```cl
(ql:quickload '(#:clack #:clack-handler-hunchentoot))
(defvar *app*
    (clack:clackup
      (lambda (env)
        '(200 (:content-type "text/plain") ("Hello, Clack!")))))
```

サーバは立てられたのでめでたしめでたし。
ではあるが、これではLispの強みを全く活かせていないので、段階的にLispっぽい開発に移行する。

まず、app.lispに分離する。

```cl
;;;; app.lisp
(ql:quickload '(#:clack #:clack-handler-hunchentoot))

(defun handler (env)
  '(200 (:content-type "text/plain") ("Hello, Clack!")))

(defvar *app* nil)

(defun stop-server ()
  (when *app*
    (clack:stop *app*)
    (setf *app* nil)))

(defun start-server ()
  (stop-server)
  (setf *app* (clack:clackup
                (lambda (env) (handler env))
                :port 5000)))
```

これをREPLでロードし、`start-server`を呼ぶ(念のため、先のREPLとは異なるセッションを使う)。
これで先と同様にサーバが起動する。

```cl
(load "app.lisp")
(start-server)
```

ここで、`handler`を少し編集する。

```cl
(defun handler (env)
  '(200 (:content-type "text/plain") ("Welcome, Clack!")))
```

REPL上でリロードする。
その後、localhost:5000にアクセスすると、"Welcome, Clack!"が返ってくる。
Lispらしくサーバを再起動せずに挙動を変えられた。

ところで、LisperはやたらEmacsの話をする。
SLIMEというプラグインがLispの開発に便利だから。
SLIMEは外部プロセスとして起動しているREPLにSwankプロトコルを介して指令を送れる開発機構。

まず、REPL側でSwankサーバを立てる。

```cl
(ql:quickload '#:swank)
(swank:create-server :port 4005 :dont-close t)
```

ぼくはNeovimmerなので、残念ながらEmacsは使えない。
が、NeovimにもConjureという似たプラグインがある。
これを入れる(vlimeはうまく動かなかった)。

```lua
-- tree sitterが必要(割愛)
return {
  'Olical/conjure',
  ft = { 'lisp' },
  init = function()
    -- Log HUDは邪魔なので消す
    -- Logは<leader>lsとかでバッファとして表示できる
    -- SEE: :help conjure-mappings
    vim.g['conjure#log#hud#enabled'] = false
  end,
}
```

app.lispを開くとREPLに繋がる。

```
; --------------------------------------------------------------------------------
; 127.0.0.1:4005 (connected)
```

Neovim上で次の操作ができる:

- `<leader>ef`: ファイル全体を評価
- `<leader>er`: カーソル位置のルートフォームを評価
- `<leader>ee`: カーソル位置のフォームを評価

つまり、app.lisp上の`handler`を次のように編集し、カーソルが`handler`内部にある状態で`<leader>er`を実行すると、`handler`が再定義され、サーバの挙動も更新される。

```cl
(defun handler (env)
  '(200 (:content-type "text/plain") ("Updated from Conjure")))
```

このSwank越しの評価は(一見すると)フォームの送信にすぎない。
だから、`(+ 1 2)`を評価すればREPL上で3に評価されるだけであるし、`(stop-server)`を評価すればサーバが止まる。
逆に、手元の環境を再現するものではない。
だから、何らかのファイルを読もうとしても、REPLの実行環境にそのファイルがなければ、当然ながらエラーになる。
このことは後述するQuicklisp+ASDFによるアプリケーションのパッケージ化で顕著に厄介になる。

プロジェクトが大きくなるにつれて、必要なライブラリの数やソースファイルの数が増えてくる。
修正するたびに評価していれば良いが、大量の修正を入れてしまった場合は全体の更新をしたいこともある。
そういった場合に備えてASDFによってパッケージ化しておくと良い。
次のような.asdファイルとpackage.lispを作る。

```cl
;;;; server.asd
(defsystem "server"
           :depends-on (#:clack
                        #:clack-handler-hunchentoot)
           :serial t
           :components ((:file "src/handler")
                        (:file "src/app")))

;;;; package.lisp
(defpackage #:server
  (:use #:cl)
  (:export #:start-server
           #:stop-server
           #:*app*))
(in-package #:server)
```

これにより`server`というパッケージが作成され、Quicklispによってロードできる。
しかし、Quicklispがこのパッケージを取得するためには、手元では、~/.roswell/lisp/quicklisp/local-projects/になければならない。
これはシンボリックリンクを使って解決できる。

```
ln -s /path/to/files/dir ~/.roswell/lisp/quicklisp/local-projects/server
```

次のように利用できるできるようになる。
`(ql:quickload '#:server)`を再評価すれば全ファイルがリロードされる。

```cl
(ql:quickload '#:server)
(server:start-server)
```
