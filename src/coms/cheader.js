const COMMON = `<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">`

exports.run = function(text, eohs) {
  let node = COMMON
  for (const eoh of eohs) {
    node += eoh
  }
  return text.replaceAll("<CHeader />", node)
}
