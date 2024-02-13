const fs   = require("fs")
const cbody = require("./coms/cbody")
const cheader = require("./coms/cheader")
const cimage = require("./coms/cimage")
const codeblock = require("./coms/codeblock")
const deadline = require("./coms/deadline")
const headline = require("./coms/headline")
const math = require("./coms/math")
const postIndex = require("./coms/post-index")
const postTitle = require("./coms/post-title")
const quoteblock = require("./coms/quoteblock")
const tombstone = require("./coms/tombstone")

function doForHTMLXD(htmlFullPath, outFullPath) {
  fs.readFile(htmlFullPath, { encoding: "utf8" }, (err, text) => {
    if (err) {
      throw err
    }

    const eohs = []
    text = cbody.run(text, eohs)
    text = cimage.run(text, eohs)
    text = codeblock.run(text, eohs)
    text = deadline.run(text, eohs)
    text = headline.run(text, eohs)
    text = math.run(text, eohs)
    text = postIndex.run(text, eohs)
    text = postTitle.run(text, eohs)
    text = quoteblock.run(text, eohs)
    text = tombstone.run(text, eohs)

    text = cheader.run(text, eohs)

    fs.writeFile(outFullPath, text, (err) => {
      if (err) {
        throw err
      }
    })
  })
}

function createFunctionDoForFileOrDirectory(path) {
  return (err, fileOrDirs) => {
    if (err) {
      throw err
    }

    const doForFile = (htmlFullPath, outFullPath) => {
      if (/.*\.html\.xd$/.test(htmlFullPath)) {
        doForHTMLXD(htmlFullPath, outFullPath.replace(/\.xd$/, ""))
      } else {
        fs.copyFile(htmlFullPath, outFullPath, (err) => {
          if (err) {
            throw err
          }
        })
      }
    }
    
    for (const n of fileOrDirs) {
      const fileOrDir = path + "/" + n
      const htmlFullPath = "./html" + fileOrDir
      const outFullPath = "./out" + fileOrDir
      if (fs.statSync(htmlFullPath).isFile()) {
        doForFile(htmlFullPath, outFullPath)
      } else {
        if (!fs.existsSync(outFullPath)) {
          fs.mkdirSync(outFullPath)
        }
        fs.readdir(htmlFullPath, createFunctionDoForFileOrDirectory(fileOrDir))
      }
    }
  }
}

if (!fs.existsSync("./out")) {
  fs.mkdirSync("./out")
}
fs.readdir("./html", createFunctionDoForFileOrDirectory(""))