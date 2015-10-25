var fs = require('fs'),
    CompressJs = require('./CompressJs.js')

module.exports = function (file) {
    var source = fs.readFileSync(file + '.js', 'utf8')
    var compressedSource = CompressJs(source)
    fs.writeFileSync('compressed.js', compressedSource)
}
