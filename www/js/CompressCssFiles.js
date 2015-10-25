var fs = require('fs'),
    uglifyCss = require('uglifycss')

module.exports = function (files) {

    var source = ''
    files.forEach(function (file) {
        source += fs.readFileSync(file + '.css', 'utf-8') + '\n'
    })

    var compressCss = uglifyCss.processString(source)
    fs.writeFileSync('compressed.css', compressCss)

}
