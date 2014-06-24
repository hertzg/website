#!/usr/bin/env node

function scan (dir) {
    var files = fs.readdirSync(dir)
    files.forEach(function (file) {

        if (/^\./.test(file)) return

        file = dir + '/' + file

        if (/\.(css|js|php|sh)$/.test(file) &&
            !(/\.(combined|compressed)\.(css|js)$/.test(file))) {

            var content = fs.readFileSync(file, 'utf8')
            var numLines = content.split(/\n/).length
            if (numLines > 100) {
                foundFiles.push({
                    file: file.substr(2),
                    numLines: numLines,
                })
            }

        } else {
            var stat = fs.statSync(file)
            if (stat.isDirectory()) scan(file)
        }

    })
}

var foundFiles = []

var fs = require('fs')

process.chdir(__dirname)
process.chdir('..')
process.stdout.on('error', function () {})

scan('.')
foundFiles.sort(function (a, b) {
    return b.numLines - a.numLines
})
foundFiles.forEach(function (foundFile) {
    console.log(foundFile.file + ':' + foundFile.numLines)
})
