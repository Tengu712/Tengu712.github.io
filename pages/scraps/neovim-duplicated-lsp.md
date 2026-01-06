---
title: Neovim LSPクライアント多重起動回避
topic: neovim
tags: ["lsp"]
index: false
---

Neovim v0.11から`vim.lsp.config['clangd'] = {...}; vim.lsp.enable('clangd')`のようにLSPを設定できるようになった。
が、[diffview.nvim](https://github.com/sindrets/diffview.nvim)を開くとLSPクライアントが多重起動することに気づいた。

原因は編集中のLSPクライアントのルートディレクトリとdiffviewのそれとが異なるため。
`print(client.config.root_dir)`等で確認すると、diffviewのそれは`.`である。

ということで、多重起動を回避する設定が↓

```lua
-- 言語ごとのLSP設定
local lsp_opts_each_lang = {
  name = 'LANGUAGE SERVER NAME',
  pattern = {'FILETYPE', 'PATTERN'},
  root_dir = {'ROOT', 'DIRECTORY', 'MARKER'},
  cmd = {'COMMAND', 'ARGUMENTS'},
  init_options = {...},
  settings = {...},
  flags = {...},
}

-- セットアップ関数
local function setup_lsp(opts)
  vim.api.nvim_create_autocmd('FileType', {
    pattern = opts.pattern,
    callback = function(args)
      local root_dir = vim.fs.root(args.buf, opts.root_dir)

      -- root_dirが相対パスなら起動しない
      -- NOTE: diffview.nvimはroot_dirが.になり、これを許すと多重起動に繋がる
      if not root_dir or root_dir:match('^%.') then
        vim.notify('tried to start LSP, ' .. opts.name .. ', at invalid root_dir: ' .. root_dir, vim.log.levels.INFO)
        return
      end

      -- 同じroot_dirを持つLSPクライアントがあれば、開いたバッファにアタッチして・startしない
      -- NOTE: これをしないと新しいバッファを開いた時にLSPが効かない
      local clients = vim.lsp.get_clients({ name = opts.name })
      for _, client in ipairs(clients) do
        if client.config.root_dir == root_dir then
          vim.lsp.buf_attach_client(args.buf, client.id)
          return
        end
      end

      vim.lsp.start {
        name = opts.name,
        cmd = opts.cmd,
        root_dir = root_dir,
        init_options = opts.init_options,
        settings = opts.settings,
        flags = opts.flags,
        capabilities = ..., -- 補完プラグインとか
        on_attach = function(client, bufnr)
          ... -- キーバインドとか
        end,
      }
    end,
  })
end

-- セットアップ
setup_lsp(lsp_opts_each_lang)
```
