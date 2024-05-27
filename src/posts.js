const POST_DATA = [
  { key: "iam-mml-release", title: "FM音源MMLコンパイラ「IAM.mml」", date: "2024/5/27", tags: ["diary", "mml", "music", "web"] },
  { key: "rust-wasm", title: "Rust WASMを試す", date: "2024/3/4", tags: ["rust", "wasm", "web"] },
  { key: "mirror-pc-to-android", title: "ウィンドウをAndroidにミラーリングする", date: "2024/2/7", tags: ["android", "windowsapi"] },
  { key: "oss-freeride", title: "OSSのフリーライドについて", date: "2024/1/2", tags: ["essay", "oss"] },
  { key: "shader-study", title: "シェーダの基礎を学習した", date: "2023/12/15", tags: ["cg"] },
  { key: "bitmap-collision", title: "ビットマップによる衝突判定", date: "2023/10/26", tags: ["experiment"] },
  { key: "cppcli-invoke-deadlock", title: "Invokeとmutexによるデッドロック", date: "2023/10/16", tags: [".net", "c++"] },
  { key: "2023-summer", title: "地獄のような夏休みを越えて", date: "2023/10/16", tags: ["diary"] },
  { key: "ai-illustration", title: "AI絵を不快に感じる理由", date: "2023/6/13", tags: ["essay"] },
  { key: "allocate-descriptor-sets", title: "VkDescriptorPoolSizeの誤りが検出されない", date: "2023/5/17", tags: ["bug", "vulkan"] },
  { key: "solink-speed", title: "DLL・SOの暗黙的/動的リンクの速度比較", date: "2023/3/30", tags: ["experiment"] },
  { key: "com-in-rust", title: "COMの構造とRust FFIで扱う手法", date: "2023/3/22", tags: ["rust", "windowsapi"] },
  { key: "stdout-speed", title: "printf vs fwrite", date: "2023/3/20", tags: ["experiment"] },
  { key: "enum-windows", title: "ウィンドウアプリケーションの列挙", date: "2023/2/14", tags: ["windowsapi"] },
  { key: "windows-to-ubuntu", title: "WindowsからUbuntuへ", date: "2022/11/22", tags: ["diary", "os"] },
  { key: "start", title: "ブログ開設", date: "2022/11/21", tags: ["diary"] },
]

exports.getDataAll = function() {
  return POST_DATA
}

exports.getDataFromKey = function(key) {
  for (const data of POST_DATA) {
    if (data.key === key) {
      return data
    }
  }
  return null
}

exports.getNextDataFromKey = function(key) {
  let next = null
  for (const data of POST_DATA) {
    if (data.key === key) {
      return next
    }
    next = data
  }
  console.log("[ warning ] posts.getNextDataFromKey(): data not found: " + key)
  return null
}

exports.getPrevDataFromKey = function(key) {
  let found = -1
  for (let i = 0; i < POST_DATA.length; ++i) {
    if (POST_DATA[i].key === key) {
      found = i;
      break;
    }
  }
  if (found === -1) {
    console.log("[ warning ] posts.getPrevDataFromKey(): data not found: " + key)
    return null;
  }
  if (found === POST_DATA.length - 1) {
    return null;
  }
  return POST_DATA[found + 1]
}
