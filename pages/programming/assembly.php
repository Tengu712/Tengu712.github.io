<div id="content-wrapper">
<div id="content">

<h1>x86-64 Assembly</h1>

<hr>

<h2>Outline</h2>

<p>
GNU Assembler(GAS)を用いたx86-64向けのアセンブリに関するメモ。
</p>

<p>
前提は以下の通り。
</p>

<ul>
  <li>x86-64</li>
  <li>Ubuntu 22.04.01 LTS</li>
  <li>GNU Assembler 2.38</li>
  <li>GCC 11.3.0</li>
  <li>gccによりビルドするためC標準ライブラリがリンクされる</li>
  <li>呼び出し規約はSystem V AMD64 ABI</li>
  <li>拡張命令セットはSSE2</li>
</ul>

<h2>Directive</h2>

<p>
GASは.rodataセクションを知らない。従って、次のように指定する必要がある。
</p>

<pre class="prettyprint">.section .rodata</pre>

<p>
.longは.intと同一で32bit値を指定する。<br>
.singleは.floatと同一で単精度浮動小数点数値を指定する。
</p>

<h2>Function</h2>

<p>
関数の処理は、次のような流れで行われる。
</p>

<ol>
  <li>
    call
    <ol>
      <li>「関数呼び出し直後の命令のアドレス」をスタックに保存</li>
      <li>関数のアドレスへジャンプ</li>
    </ol>
  </li>
  <li>
    先頭処理
    <ol>
      <li>「関数呼び出し側のベースポインタ」をスタックに保存</li>
      <li>ベースポインタをスタックポインタで上書きして「関数側のベースポインタ」を設定</li>
    </ol>
  </li>
  <li>関数の処理</li>
  <li>
    終了処理
    <ol>
       <li>スタックポインタをベースポインタで上書きしてローカル変数を解放</li>
       <li>「関数呼び出し側のベースポインタ」を復元</li>
    </ol>
  </li>
  <li>
    ret
    <ol>
      <li>「関数呼び出し直後の命令のアドレス」をripに復元</li>
    </ol>
  </li>
</ol>

<p>
引数は第一引数から第六引数まで順に以下のレジスタを用いる。第七引数以降はスタックを用いる。
</p>

<ol>
  <li>rdi</li>
  <li>rsi</li>
  <li>rdx</li>
  <li>rcx</li>
  <li>r8</li>
  <li>r9</li>
</ol>

<h2>Binary</h2>

<p>
略称として次を用いる。
</p>

<ul>
  <li>R : register</li>
  <li>SR : single precision floating point register</li>
  <li>DR : double precision floating point register</li>
  <li>imm32 : 32bit immediate value</li>
  <li>imm64 : 64bit immediate value</li>
  <li>ra : relative address</li>
</ul>

<p>
movqは次のように変化する。ただし、Opcodeの数値は16進数表記、Remarkは2進数表記。
</p>

<table>
  <tr><th>Condition</th><th>Opcode</th><th>Meaning(op src dst)</th><th>Remark</th></tr>
  <tr><td>R -> R</td><td>48 89 ModR/M</td><td>mov reg, r/m</td><td>mod=11</td></tr>
  <tr><td>imm32 -> R</td><td>48 c7 ModR/M imm32</td><td>mov r/m, imm32</td><td>mod=11</td></tr>
  <tr><td>imm64 -> R</td><td>48 b8+r/m imm64</td><td>movabs r/m, imm64</td><td></td></tr>
  <tr><td>ra -> R</td><td>48 8b ModR/M disp32</td><td>mov reg, disp32(%rip)</td><td>mod=00 r/m=101</td></tr>
  <tr><td>R -> DR</td><td>66 48 0f 6e ModR/M</td><td>movq reg r/m</td><td>mod=11</td></tr>
  <tr><td>DR -> R</td><td>66 48 0f 7e ModR/M</td><td>movq r/m reg</td><td>mod=11</td></tr>
</table>

<h2>Other</h2>

<p>
gccに次のオプションを指定して、デバッグ情報のないアセンブリをエミットする。
</p>

<pre class="prettyprint">-fno-asynchronous-unwind-tables</pre>

<p>
printf関数は単精度浮動小数点数を扱わない。
</p>

<h2>References</h2>

<ul>
  <li><a href="https://sourceware.org/binutils/docs-2.39/as/index.html">GNU "Using as"</a></li>
  <li><a href="http://ref.x86asm.net/coder64.html">X86 Opcode and Instruction Reference "coder64 edition"</a></li>
</ul>

</div>
</div>
