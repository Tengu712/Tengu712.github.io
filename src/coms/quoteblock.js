const parser = require("../parser")

const CSS = `<link rel="stylesheet" type="text/css" href="/coms/quoteblock.css?20240210">`

exports.run = function(text, eohs) {
  const matcheds = parser.parseTag(text, "Quoteblock")
  if (matcheds.length === 0) {
    return text
  }

  for (const matched of matcheds) {
    const cite = parser.getAttributeOr(matched.attributes, "cite", "")
    text = text.replace(matched.entire, `<blockquote class="quoteblock"><cite>${cite}</cite>${matched.content}</blockquote>`)
  }
  
  eohs.push(CSS)
  return text
}
