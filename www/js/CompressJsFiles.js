var fs = require('fs'),
    CompressJs = require('./CompressJs.js')

module.exports = function (files, compressedFile) {

    if (compressedFile === undefined) compressedFile = 'compressed.js'

    var source = '(function () {\n'
    files.forEach(function (file) {
        source += fs.readFileSync(file + '.js', 'utf8') + ';\n'
    })
    source += '\n})()'

    var compressedSource = CompressJs(source)

    fs.writeFileSync('combined.js', source)
    fs.writeFileSync(compressedFile, compressedSource)

}
