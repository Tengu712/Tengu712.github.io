(function () {
    document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style_common.css\">");
    if ((navigator.userAgent.indexOf("iPhone") > 0 && navigator.userAgent.indexOf("iPad") == -1)
        || navigator.userAgent.indexOf("iPod") > 0
        || navigator.userAgent.indexOf("Android") > 0) {
        document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style_phone.css\">");
    } else {
        document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style_pc.css\">");
    }
}());