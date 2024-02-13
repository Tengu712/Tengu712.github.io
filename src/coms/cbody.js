const CSS = `<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/coms/cbody.css?20240210">`

const HEAD_TOP = `<body id="cbody">
  <div id="cbody-header">
    <a href="/">天狗会議録</a>
    <a href="/">Posts</a>
    <a href="/pages">Pages</a>
    <a href="/about">About</a>
  </div>
  <div id="cbody-header-spacer"></div>
  <div id="cbody-content-wrapper">
    <img src="https://img.skdassoc.work/top.png">
    <div id="cbody-content">
`

const HEAD = `<body id="cbody">
  <div id="cbody-header">
    <a href="/">天狗会議録</a>
    <a href="/">Posts</a>
    <a href="/pages">Pages</a>
    <a href="/about">About</a>
  </div>
  <div id="cbody-header-spacer"></div>
  <div id="cbody-content-wrapper">
    <div id="cbody-content">
`

const TAIL = `    </div>
  </div>
  <div id="cbody-footer">2022-2024, Tengu712, Skydog Association</div>
</body>`

function top(text, eohs) {
  const isHead = text.includes("<CTopBody>")
  const isTail = text.includes("</CTopBody>")
  if (!isHead && !isTail) {
    return text
  }
  if (!isHead) {
    throw new Error("<CTopBody> tag not found.")
  }
  if (!isTail) {
    throw new Error("</CTopBody> tag not found.")
  }

  text = text.replace("<CTopBody>", HEAD_TOP)
  text = text.replace("</CTopBody>", TAIL)
  
  eohs.push(CSS)
  return text
}

exports.run = function(text, eohs) {
  text = top(text, eohs)

  const isHead = text.includes("<CBody>")
  const isTail = text.includes("</CBody>")
  if (!isHead && !isTail) {
    return text
  }
  if (!isHead) {
    throw new Error("<CBody> tag not found.")
  }
  if (!isTail) {
    throw new Error("</CBody> tag not found.")
  }

  text = text.replace("<CBody>", HEAD)
  text = text.replace("</CBody>", TAIL)
  
  eohs.push(CSS)
  return text
}
