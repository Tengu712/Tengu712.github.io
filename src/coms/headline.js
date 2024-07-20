const parser = require("../parser")
const posts = require("../posts")
const tagsDate = require("./tags-date")

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

    const td = tagsDate.run(data, eohs)
    text = text.replace(matched.entire, `<div class="headline"><h1>${data.title}</h1>${td}</div>`)
  }

  return text
}
