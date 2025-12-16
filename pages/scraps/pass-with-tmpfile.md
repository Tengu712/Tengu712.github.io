---
title: 一時ファイルを編集させて値を得る
topic: cli
tags: ["go"]
index: false
---

Gitのコミット編集やClaude Codeのプロンプト指定等、時々CLIツールには一時ファイルを編集させて値を得るものがある。

CLIツールなのだから、引数を与えるだとか・インタラクティブシェルだとかで指定するのが自然だとは思うのだが、ものによっては設計が複雑になったり・そもUXが悪くなったりすることがある。
その場合、この一時ファイルを介す方式はとても良いソリューションとなる。

以下はGo言語での実装であるが、恐らく多くの言語で簡単に書けるだろう:

```go
package main

import (
	"os"
	"os/exec"
)

func EditWithEditor(initial string) ([]byte, error) {
	tmpfile, err := os.CreateTemp("", "edit")
	if err != nil {
		return nil, err
	}
	defer os.Remove(tmpfile.Name())

	if _, err := tmpfile.WriteString(initial); err != nil {
		return nil, err
	}

	// ここではNeovimを指定しているが、
	// 何らかの方法で規定のエディタを取得してみてもいいかもしれない
	cmd := exec.Command("nvim", tmpfile.Name())
	cmd.Stdin = os.Stdin
	cmd.Stdout = os.Stdout
	cmd.Stderr = os.Stderr
	if err := cmd.Run(); err != nil {
		return nil, err
	}

	if content, err := os.ReadFile(tmpfile.Name()); err != nil {
		return nil, err
	} else {
		return content, nil
	}
}
```
