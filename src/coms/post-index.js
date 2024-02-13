const posts = require("../posts")

const CSS = `<link rel="stylesheet" type="text/css" href="/coms/post-index.css?20240212">`

exports.run = function(text, eohs) {
  if (!text.includes("<PostIndex />")) {
    return text
  }

  let node = ""
  for (const data of posts.getDataAll()) {
    let spans = "";
    for (const tag of data.tags) {
      spans += "<span>#" + tag + "</span>";
    }
    spans += "<span>" + data.date + "</span>"

    node += `<div class="post-index"><div><a href="/posts/${data.key}">${data.title}</a></div><div>${spans}</div></div>`
  }

  eohs.push(CSS)
  return text.replaceAll("<PostIndex />", node)
}
