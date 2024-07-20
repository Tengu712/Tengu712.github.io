const cssq = require("../cssq")
const parser = require("../parser")

const CSS = `<link rel="stylesheet" type="text/css" href="/coms/cimage.css?${cssq.CSSQ}">`

exports.run = function(text, eohs) {
  const matcheds = parser.parseSelfClosingTag(text, "CImage")
  if (matcheds.length === 0) {
    return text
  }

  let count = 1
  for (const matched of matcheds) {
    const src = parser.getAttributeOr(matched.attributes, "src", "")
    const width = parser.getAttributeOr(matched.attributes, "width", "100%")
    const caption = parser.getAttributeOr(matched.attributes, "caption", "")
    if (src === "") {
      console.log("[ warning ] cimage.run(): src not defined: " + matched)
    }
    text = text.replace(matched.entire, `<div class="cimage"><img src="${src}" width="${width}"><br><label>図${count} ${caption}</label></div>`)
    count += 1
  }
  
  eohs.push(CSS)
  return text
}
