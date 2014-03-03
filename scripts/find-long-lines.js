#!/usr/bin/env node

function scan (dir) {
    var files = fs.readdirSync(dir)
    files.forEach(function (file) {
        if (/^\./.test(file)) return
        file = dir + '/' + file
        if (/\.(css|js|php|sh)$/.test(file)) {
            var content = fs.readFileSync(file, 'utf8')
            var lines = content.split(/\r\n|\r|\n/)
            lines.forEach(function (line, index) {
                if (line.length > 100) {
                    foundLines.push({
                        file: file.substr(2),
                        line: line,
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
process.stdout.on('error', function (error) {})

var fs = require('fs')

var foundLines = []

scan('.')
foundLines.sort(function (a, b) {
    return b.line.length - a.line.length
})
foundLines.forEach(function (foundFile) {
    console.log(foundFile.file + ':' + foundFile.lineNumber + ':' + foundFile.line)
})
