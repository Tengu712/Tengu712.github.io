const parser = require("../parser")
const posts = require("../posts")

const CSS = `<link rel="stylesheet" type="text/css" href="/coms/deadline.css?20240212">`

exports.run = function(text, eohs) {
  const matcheds = parser.parseSelfClosingTag(text, "Deadline")
  if (matcheds.length === 0) {
    return text
  }

  for (const matched of matcheds) {
    const key = parser.getAttributeOr(matched.attributes, "key", "")
    const next = posts.getNextDataFromKey(key)
    const prev = posts.getPrevDataFromKey(key)
    const nextDiv = next ? `<div><div>Next Article</div><div><a href="/posts/${next.key}">${next.title}</a></div></div>` : "<div></div>"
    const prevDiv = prev ? `<div><div>Prev Article</div><div><a href="/posts/${prev.key}">${prev.title}</a></div></div>` : "<div></div>"
    text = text.replace(matched.entire, `<div class="deadline">${nextDiv}${prevDiv}</div>`)
  }
  
  eohs.push(CSS)
  return text
}
