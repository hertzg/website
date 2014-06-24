#!/usr/bin/env node

function scan (dir) {
    var files = fs.readdirSync(dir)
    files.forEach(function (file) {

        if (/^\./.test(file)) return

        file = dir + '/' + file

        if (/\.(css|js|php|sh)$/.test(file) &&
            !(/\.(combined|compressed)\.(css|js)$/.test(file))) {

            var content = fs.readFileSync(file, 'utf8')
            var lines = content.split(/\r\n|\r|\n/)
            lines.forEach(function (line, index) {
                if (line.match(/\s+$/)) {
                    foundLines.push({
                        file: file.substr(2),
                        lineNumber: index + 1,
                    })
                }
            })

        } else {
            var stat = fs.statSync(file)
            if (stat.isDirectory()) scan(file)
        }

    })
}

process.chdir(__dirname)
process.chdir('..')
process.stdout.on('error', function () {})

var fs = require('fs')

var foundLines = []

scan('.')
foundLines.forEach(function (foundFile) {
    console.log(foundFile.file + ':' + foundFile.lineNumber)
})
