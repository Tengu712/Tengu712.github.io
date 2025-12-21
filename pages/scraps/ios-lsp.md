---
title: "Neovim+SourceKit-LSP"
topic: "neovim"
tags: ["lsp", "swift"]
index: false
---

事前準備

- sourcekit-lspがインストールされていることを確認
- xcode-build-serverをインストール

[ビルドスクリプト](../ios-cli)内でbuildServer.jsonを生成

```sh
xcode-build-server config -scheme "$SCHEME_NAME" -project "$PROJECT_FILE"
xcode-build-server parse -a < xcodebuild.log
```

Neovimで設定([setup_lsp関数](../neovim-duplicated-lsp)に渡す)

```lua
return {
  name = 'sourcekit',
  pattern = {'swift'},
  root_dir = {
    'buildServer.json',
    '*.xcodeproj',
    '*.xcworkspace',
    'Package.swift',
    '.git',
  },
  cmd = {
    'xcrun',
    '--toolchain',
    'swift',
    'sourcekit-lsp',
  },
}
```

注意:

- sourcekit-lsp単体でも大抵の場合動くが、SwiftUI等Xcode由来の云々を使う場合はxcode-build-serverが必須
- SwiftのLSPとしてcompile_commands.jsonを使うことが書かれている文献もあるが、これはSwift用であってXcode用ではない
