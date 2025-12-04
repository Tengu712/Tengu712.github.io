---
title: Neovim+clangd
topic: neovim
tags: ["c/cpp"]
---

```lua
vim.lsp.config['clangd'] = {
  capabilities = require('blink.cmp').get_lsp_capabilities(),

  filetypes = {'c', 'h', 'cpp', 'hpp'},

  root_markers = {{'.clangd', 'compile_commands.json', 'compile_flags.txt'}, '.git'},

  cmd = {
    'clangd',
    '--background-index',
    '--clang-tidy',
    '--completion-style=detailed',
    '--function-arg-placeholders',
    '--fallback-style=llvm',
    '--header-insertion=never',
  },

  init_options = {
    usePlaceholders = true,
    clangdFileStatus = true,
    completeUnimported = false,
  },

  settings = {
    clangd = {
      semanticHighlighting = true,
    },
  },
}

vim.lsp.enable('clangd')
```

- Neovim: v0.11.5
- LLVM: 21.1.6

CMakeやMeson等で生成された特定のディレクトリにあるcompile_commands.jsonを参照したい場合は次のような.clangdを配置する:

```
CompileFlags:
  CompilationDatabase: compile_commands.jsonのあるディレクトリパス
```

- Neovim v0.11から `vim.clangd.setup()` が非推奨になった
- `filetypes` の指定がないと想定しないファイルでも動作してしまう
- WindowsではLLVM 19以上でないとエラーになる
