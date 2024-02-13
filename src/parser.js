function parseAttributes(text) {
  const matcheds = text.match(/\w+?=".*?"/g)
  if (!matcheds) {
    return []
  }
  
  const attributes = []
  for (const matched of matcheds) {
    const attribute = matched.match(/(\w+?)="(.*?)"/)
    attributes.push({
      entire: attribute[0],
      name: attribute[1],
      value: attribute[2],
    })
  }

  return attributes
}

exports.parseSelfClosingTag = function(text, tag) {
  const matcheds = text.match(new RegExp("<" + tag + "[\\s\\S]*? />", "g"))
  if (!matcheds) {
    return []
  }
  
  const parsereds = []
  for (const matched of matcheds) {
    parsereds.push({
      entire: matched,
      attributes: parseAttributes(matched),
    })
  }
  
  return parsereds
}

exports.parseTag = function(text, tag) {
  const matcheds = text.match(new RegExp("<" + tag + "[\\s\\S]*?>[\\s\\S]*?</" + tag + ">", "g"))
  if (!matcheds) {
    return []
  }
  
  const parsereds = []
  for (const matched of matcheds) {
    const head = matched.match(new RegExp("<" + tag + "[\\s\\S]*?>"))
    const content = matched.match(new RegExp("<" + tag + "[\\s\\S]*?>([\\s\\S]*?)</" + tag + ">"))
    parsereds.push({
      entire: matched,
      attributes: parseAttributes(head[0]),
      content: content[1],
    })
  }

  return parsereds
}

exports.getAttributeOr = function(attributes, name, defValue) {
  for (const attribute of attributes) {
    if (attribute.name === name) {
      return attribute.value
    }
  }
  return defValue
}
