const CSS = `<link rel="stylesheet" type="text/css" href="/coms/tags-date.css?20240721">`

exports.run = function(data, eohs) {
  eohs.push(CSS)

  let s = ""
  for (const tag of data.tags) {
    s += "#" + tag + " "
  }
  const tags = s.slice(0, -1)
  const date = data.date

  return `<div class="tag-date"><div class="tag-date-tags">${tags}</div><div class="tag-date-date">${date}</div></div>`
}
