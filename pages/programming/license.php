<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/head.html"); ?>
    <title>ライセンスあれこれ</title>
    <style>
        p.emp {
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.html"); ?>

    <div id="content-wrapper">
        <div id="content">
            <h1>ライセンスあれこれ</h1>

            <p class="emp"><b>
                ライセンスは著作権法等の法と密接に関わる文書であり、その問題は最終的に司法に委ねられる。
                ライセンシーの義務は各ライセンスに依存し、書いてあること以上のことを察さねばならない。
            </b></p>

            <p class="emp"><b>
                私は法そのものが大嫌いだが、だからこそ、権利問題がおざなりにされることが腹立たしい。
                人を犯罪者扱いするなら、法の従事者に対して十分な教育をし、かつ法自体を誤解の生じづらい体制で管理していただきたい。
            </b></p>

            <p class="emp"><b>
                一週間ずっと調べ回ってみたが、ほぼすべての解説が食い違うため、正しい情報をまとめることを断念した。
                この頁には、明らかに正しい解説・解釈と、明らかでない事柄をまとめる。
            </b></p>

            <h2>GPLv3</h2>

	    <p>
		<a href="https://www.gnu.org/licenses/gpl-3.0.html">原文</a>、
                <a href="https://mag.osdn.jp/07/09/02/130237">日本語訳</a>。
            </p>

	    <p>GPLv3 licensedされた著作物(A)、これを利用する第二者(B)、第三者(C)を考える。</p>

            <ul>
                <li><i>(C)が(A)を複製できない限り、(B)は無条件に(A)を利用できる？(GPLv3, 2. Basic Permissions.)</i></li>
                <li>(B)は(A)をそのまま(C)に再頒布するとき、(A)のライセンス内容を告知すると同時に(A)と共に(A)の許諾書を表示しなければならない。(GPLv3, 4. Converying Verbatim Copies.)</li>
                <li>(B)は(A)を改変した<b>ソースコード</b>(B-1)を(C)に頒布するとき、(A)のライセンス内容・許諾書・(A)を改変したという事実・改変日時を明記すると同時に、(B-1)全体に(A)と同様のライセンスを施して、その許諾書を表示しなければならない。(GPLv3, 5. Conveying Modified Source Versions.)</li>
                <li>(B)は(A)を<b>ソースコード以外の形式のコード</b>(B-2)で(C)に頒布するとき、(A)のライセンス内容・許諾書を明記すると同時に、(B-2)全体に(A)と同様のライセンスを施して、その許諾書を表示し、(B-2)の<b>ソースコードを開示</b>しなければならない。(この開示方法には幾つか選択肢がある)(GPLv3, 6. Conveying Non-Source Forms.)</li>
            </ul>

            <p><i>GPLv3 licensedな著作物が混入しないいかなる利用には、ライセンス表示義務がない？　つまり、外部プロセス実行でGPLv3 licensedされたプログラムを実行しても、そのプログラムに言及する義務がない？</i></p>

            <h3>GCC RLE</h3>

            <p><a href="https://www.gnu.org/licenses/gcc-exception-3.1.ja.html">GCC Runtime Library Exception</a>は、GPLv3, 7. Additional Terms.によって適用される追加許可。この例外が適用された著作物(A)を第二者(B)が利用してプロダクト(B-1)を作るとき、(B-1)がGPLv3を侵害するとしても問題がない、という許可である。</p>

            <p>
		ただし、例外が適用されたRuntime Libraryをリストアップすることは容易でない。
                というか、恐らくGNUはまともに示していない。
                一応、ヘッダーファイルならその冒頭を、オブジェクトファイルならソースファイルの冒頭を見れば示されていることもある。
                ものによっては、GCCが勝手にリンクするいかなるライブラリはGCC RLEが適用される、とも取れる解説をしているが、その根拠は示されていない。
            </p>

            <h3>License List</h3>

            <p>Archlinuxで空のCコードを実行可能バイナリまでビルドしたとき、リンカでリンクされるファイルのライセンスに関する詳細は以下のようである。</p>

            <ul>
                <li>Scrt1.o (glibc)
                    <ul>
                        <li>license : LGPLv2.1</li>
                        <li>local  : /lib/Scrt1.o</li>
                        <li>src    : <i>/glibc/sysdeps/x86-64/start.S</i></li>
                        <li>start.Sの冒頭には、改変したりそのまま再頒布したりせず、何かにリンクして頒布する場合に限り、制限を設けないと示してある。</li>
                    </ul>
                </li>
                <li>crti.o
                    <ul>
                        <li>license : LGPLv2.1</li>
                        <li>local  : /lib/crti.o</li>
                        <li>src    : /glibc/sysdeps/x86-64/crti.S</li>
                        <li>crti.Sの冒頭には、crti.oをリンクする上では、何の制限も課せられないことが示してある。</li>
                    </ul>
                </li>
                <li>crtbeginS.o
                    <ul>
                        <li>license : ?</li>
                        <li>local  : /lib/gcc/x86_64-pc-linux-gnu/12.2.1/crtbeginS.o</li>
                        <li>src    : ?</li>
                    </ul>
                </li>
                <li>libgcc
                    <ul>
                        <li>license : GPLv3 + GCC RLE</li>
                        <li>local  : /lib/gcc/x86_64-pc-linux-gnu/12.2.1/libgcc.a</li>
                        <li><a href="https://www.gnu.org/licenses/gcc-exception-3.1-faq.ja.html">GNUのFAQ</a>にlibgccがGPLv3+GCC RLEであることが書かれている。</li>
                    </ul>
                </li>
                <li>libgcc_s
                    <ul>
                        <li>license : GPLv3 + GCC_RLE</li>
                        <li>local  : /lib/libgcc_s.so</li>
                        <li><a href="https://www.gnu.org/licenses/gcc-exception-3.1-faq.ja.html">GNUのFAQ</a>にlibgccがGPLv3+GCC RLEであることが書かれている。</li>
                    </ul>
                </li>
                <li>libc
                    <ul>
                        <li>license : LGPLv2.1</li>
                        <li>local  : /lib/libc.a</li>
                        <li><i>/glibc/COPYING.LIBがライセンスファイル？ 例外がないのでライセンス表示義務があると思うが……。</i></li>
                    </ul>
                </li>
                <li>crtendS.o
                    <ul>
                        <li>license : ?</li>
                        <li>local  : /lib/gcc/x86_64-pc-linux-gnu/12.2.1/crtendS.o</li>
                        <li>src    : ?</li>
                    </ul>
                </li>
                <li>crtn.o
                    <ul>
                        <li>license : LGPLv2.1</li>
                        <li>local  : /lib/crtn.o</li>
                        <li>src    : /glibc/sysdeps/x86-64/crtn.S</li>
                        <li>crtn.Sの冒頭には、crtn.oをリンクする上では、何の制限も課せられないことが示してある。</li>
                    </ul>
                </li>
            </ul>

            <h2>MIT License</h2>

            <p>
                <a href="https://opensource.org/license/mit/">原文</a>、
                <a href="https://licenses.opensource.jp/MIT/MIT.html">日本語訳</a>。
            </p>

            <p>ライセンス表示義務があるのでおとなしく表示する。</p>

	    <p>原文にはMIT licensedな"Software"を"deal"することについて、ライセンス表示をする限り無制限に許可すると書いてある。<i>"deal"の意味は後の"use, copy, modify..."と同一であると考えられる？　その場合、"use"とは？　利用物に著作物が含まれない利用も該当する？　例えばMIT licensedなエディタを用いてコーディングしたとき、ライセンス表示義務がある？</i></p>

        </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.html"); ?>
</body>

</html>
