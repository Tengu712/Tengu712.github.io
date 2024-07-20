const parser = require("../parser")
const posts = require("../posts")

exports.run = function(text, eohs) {
  const matcheds = parser.parseSelfClosingTag(text, "PostTitle")
  if (matcheds.length === 0) {
    return text
  }
  if (matcheds.length > 1) {
    console.log("[ warning ] post-title.run(): the number of <PostTitle> tag must be 1 but found " + matcheds.length)
  }

  const matched = matcheds[0]
  const key = parser.getAttributeOr(matched.attributes, "key", "")
  const data = posts.getDataFromKey(key)
  if (!data) {
    console.log("[ warning ] post-title.run(): data not found: " + key)
    return text
  }

  text = text.replace(matched.entire, "")
  eohs.push(`<title>${data.title}</title>`)
  return text
}
