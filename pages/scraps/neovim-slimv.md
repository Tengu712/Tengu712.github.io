---
title: slimvのChanging a readonly file警告とSwankのSTYLE-WARNINGの抑制
topic: commonlisp
tags: ["neovim", "vim"]
index: false
---

Common Lispで次のようにSwankサーバを立てる:

```cl
(ql:quickload '#:swank)
(swank:create-server :port 4005 :dont-close t)
```

slimvを使うと、`,c`でSwankサーバのREPLをverticalに開ける。
しかし、このとき、readonlyバッファへの書込み警告が出る。
Neovim:

```
Error detected while processing function SlimvConnectServer[7]..SlimvConnectSwank[63]..SlimvCommandGetResponse[11]..provider#python3#Call[1]..SlimvCommandGetResponse:
line   11:
W10: Warning: Changing a readonly file
```

Vim:

```
function SlimvConnectServer[7]..SlimvConnectSwank[63]..SlimvCommandGetResponse の処理中にエラーが検出されました:
行   11:W10: 警告: 読込専用ファイルを変更します
```

原因は[s:SplitView](https://github.com/kovisoft/slimv/blob/dfa79147c1be5694475f1240d57c7052b72b53a4/ftplugin/slimv.vim#L684)でreadonlyバッファを開いた時、恐らく


これはslimvをNeovimで動かしたとき固有の問題である。
Vimでは何も問題がない。
slimvがreadonlyバッファを作成し、その後Pythonがそのバッファへ操作を行う。
残念ながら正規の方法では解決できない。
本来ならslimvのIssue行きの問題である。
が、slimvはVim用のプラグインであってNeovim用ではない。
ので、自力解決する。
解決するには~/.local/share/nvim/lazy/slimv/ftplugin/slimv.vimの[s:SplitView](https://github.com/kovisoft/slimv/blob/dfa79147c1be5694475f1240d57c7052b72b53a4/ftplugin/slimv.vim#L684)のreadonlyバッファ作成を非readonlyバッファ作成に変える:

```

```
