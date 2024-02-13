const CSS = `<link rel="stylesheet" type="text/css" href="/coms/tombstone.css?20240210">`

const NODE = `<p class="tombstone">■</p>`

exports.run = function(text, eohs) {
  if (!text.includes("<Tombstone />")) {
    return text
  }
  eohs.push(CSS)
  return text.replaceAll("<Tombstone />", NODE)
}
