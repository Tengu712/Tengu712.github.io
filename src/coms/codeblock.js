const parser = require("../parser")

const CSS = `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
  <script>hljs.configure({languages: []}); hljs.initHighlightingOnLoad();</script>
  <link rel="stylesheet" type="text/css" href="/coms/codeblock.css?20240305">`

exports.run = function(text, eohs) {
  const matcheds = parser.parseTag(text, "Codeblock")
  if (matcheds.length === 0) {
    return text
  }

  for (const matched of matcheds) {
    const lang = parser.getAttributeOr(matched.attributes, "lang", "")
    const langClass = lang ? lang : ""
    text = text.replace(matched.entire, `<pre><code class="${langClass}">${matched.content}</code></pre>`)
  }
  
  eohs.push(CSS)
  return text
}
