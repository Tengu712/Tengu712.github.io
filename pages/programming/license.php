<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/head.html"); ?>
    <title>ライセンスあれこれ</title>
</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.html"); ?>

    <div id="content-wrapper">
        <div id="content">
            <h1>ライセンスあれこれ</h1>

            <h2>はじめに</h2>

            <p>
                人類が社会を形成し、かつ無から物質を生成しえない限り、権利問題が発生する。
                ソフトウェア開発もまた、気にすべきことは数知れない。
            </p>

            <p>
                ソフトウェアのライセンスは、取り扱いをしくじると訴訟されるくせに、極めて仕様がわかりづらい。
                ネットを検索しまくっても、ChatGPTに調べさせても、明確な情報は一切見つからない。
                そのため、すべての外部向けのプロダクトを開発する者は、べつに法学部の学生でもないのに法律を読むようなことをしなければならない。
                これは結局のところ、個々のライセンスが正義となるために、抽象化できる事柄が少ないからである。
                よって、この頁も個々の事象に対するメモとなることを容赦してほしい。
            </p>

            <h2>MITとかApacheとか</h2>

            <p>
                ライセンス表示義務があるので、大人しくライセンスをコピる。ただし、稀に追加ライセンスとして、バイナリ形式で再頒布する場合はライセンス表示義務がないとするものもある。
            </p>

            <h2>GPL</h2>

            <h3>GCC RLE</h3>

            <p>
                <a href="https://www.gnu.org/licenses/gcc-exception-3.1.ja.html">GCC Runtime Library
                    Exception</a>は、GPLv3のSection
                7によって適用される追加許可で、たとい目的コードがGPLv3に侵害するとしても、GCCあるいは他のGPL互換のあるツールによって<b>Runtime
                    Library</b>を目的コードに伝播できることを示すものである。
            </p>

            <p>
                この<b>Runtime Library</b>は、GCC RLEが適用されたファイルのことであるが、それらが何であるかリストアップすることは容易でない。
            </p>

            <p>
                ヘッダーファイルをincludeしたときは、ヘッダーファイルの冒頭を読めば良い。
                たとえば、mingwのwindows.hはパブリックドメイン。
            </p>

        </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.html"); ?>
</body>

</html>