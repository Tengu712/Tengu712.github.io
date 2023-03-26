<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/head.html"); ?>
  <title>LaTeX 技術系同人誌用テンプレート</title>
</head>

<body>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.html"); ?>

  <div id="content-wrapper">
    <div id="content">
        <h1>LaTeX 技術系同人誌用テンプレート</h1>
        <hr>
        <pre class="codeblock latex">% 本形式 11pt
% 章は左右どちらでも開始可能
\documentclass[11pt, openany]{jsbook}

% JISB5 余白は上下外0.5inchずつ、内0.8inch
\usepackage[b5j, truedimen, includeheadfoot, margin=36pt, inner=57.6pt]{geometry}
% warning防止
\setlength{\footskip}{16.0pt}

% ノンブルをデザインするパッケージ
\usepackage{fancyhdr}
% 通常ページ
\fancypagestyle{defaultpagestyle}{
  \fancyhead{}
  \fancyhead[LE]{\leftmark}
  \fancyhead[RO]{\rightmark}
  \fancyfoot{}
  \fancyfoot[LE,RO]{\thepage}
}
\renewcommand{\chaptermark}[1]{\markboth{第\ \thechapter\ 章\ \ #1}{}}
\pagestyle{defaultpagestyle}
% チャプターページ
\fancypagestyle{chapterpagestyle}{
  \fancyhead{}
  \fancyfoot{}
  \fancyfoot[LE,RO]{\thepage}
  \renewcommand{\headrulewidth}{0pt}
}

% chapterページでpagestyleがplainになるのを防ぐラッパーマクロ
\newcommand{\wchapter}[1]{{\chapter{#1}\thispagestyle{chapterpagestyle}}}

% URLを中央寄せで表示するラッパーマクロ
\usepackage{url}
\newcommand{\wurl}[1]{\bigskip\centerline{\url{#1}}\bigskip}

% 注釈を[n]形式にする
\renewcommand{\thefootnote}{[\arabic{footnote}]}
% 注釈の罫線の長さを100%にする
\renewcommand{\footnoterule}{\noindent\rule{\textwidth}{0.3mm}\medskip}

% ============================================================================== %

\begin{document}
\end{document}</pre>
    </div>
  </div>
  
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.html"); ?>
</body>

</html>
