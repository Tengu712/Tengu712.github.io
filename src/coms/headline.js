const parser = require("../parser")
const posts = require("../posts")

const CSS = `<link rel="stylesheet" type="text/css" href="/coms/headline.css?20240212">`

exports.run = function(text, eohs) {
  const matcheds = parser.parseSelfClosingTag(text, "Headline")
  if (matcheds.length === 0) {
    return text
  }
  
  for (const matched of matcheds) {
    const key = parser.getAttributeOr(matched.attributes, "key", "")
    const data = posts.getDataFromKey(key)
    if (!data) {
      console.log("[ warning ] headline.run(): data not found: " + matched)
      continue
    }

    let spans = "";
    for (const tag of data.tags) {
      spans += "<span>#" + tag + "</span>";
    }
    spans += "<span>" + data.date + "</span>"

    text = text.replace(matched.entire, `<div class="headline"><h1>${data.title}</h1><div>${spans}</div></div>`)
  }

  eohs.push(CSS)
  return text
}
