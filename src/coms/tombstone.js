const cssq = require("../cssq")

const CSS = `<link rel="stylesheet" type="text/css" href="/coms/tombstone.css?${cssq.CSSQ}">`

const NODE = `<p class="tombstone">■</p>`

exports.run = function(text, eohs) {
  if (!text.includes("<Tombstone />")) {
    return text
  }
  eohs.push(CSS)
  return text.replaceAll("<Tombstone />", NODE)
}
