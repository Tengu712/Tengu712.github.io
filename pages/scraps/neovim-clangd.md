---
title: Neovim+clangd
topic: neovim
tags: ["c/cpp", "lsp"]
---

[setup_lsp関数](../neovim-duplicated-lsp)に次を渡す:

```lua
return {
  name = 'clangd',
  pattern = {'c', 'cpp', 'h', 'hpp'},
  root_dir = {'.clangd', 'compile_commands.json', 'compile_flags.txt', '.git'},
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
```

CMakeやMeson等で生成された特定のディレクトリにあるcompile_commands.jsonを参照したい場合は次のような.clangdを配置する:

```
CompileFlags:
  CompilationDatabase: compile_commands.jsonのあるディレクトリパス
```

注意:

- Neovim v0.11から `vim.clangd.setup()` が非推奨になった
- WindowsではLLVM 19以上でないとエラーになる
