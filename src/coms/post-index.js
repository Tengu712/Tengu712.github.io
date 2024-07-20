const posts = require("../posts")
const tagsDate = require("./tags-date")

const CSS = `<link rel="stylesheet" type="text/css" href="/coms/post-index.css?20240721">`

exports.run = function(text, eohs) {
  if (!text.includes("<PostIndex />")) {
    return text
  }

  let node = ""
  for (const data of posts.getDataAll()) {
    const td = tagsDate.run(data, eohs)
    node += `<div class="post-index"><div><a href="/posts/${data.key}">${data.title}</a></div>${td}</div>`
  }

  eohs.push(CSS)
  return text.replaceAll("<PostIndex />", node)
}
