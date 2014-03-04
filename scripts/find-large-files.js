#!/usr/bin/env node

function pad (n) {
    n = String(n)
    while (n.length < 5) n = '0' + n
    return n
}

function scan (dir) {
    var files = fs.readdirSync(dir)
    files.forEach(function (file) {
        if (/^\./.test(file)) return
        file = dir + '/' + file
        if (/\.(css|js|php|sh)$/.test(file) && !(/\.(combined|compressed)\.(css|js)$/.test(file))) {
            var content = fs.readFileSync(file, 'utf8')
            var numLines = content.split(/\n/).length
            if (numLines > 100) {
                foundFiles.push({
                    file: file,
                    numLines: numLines,
                })
            }
        } else {
            var stat = fs.statSync(file)
            if (stat.isDirectory()) {
                scan(file)
            }
        }
    })
}

var foundFiles = []

var fs = require('fs')

process.chdir(__dirname)
process.chdir('..')

scan('.')
foundFiles.sort(function (a, b) {
    return b.numLines - a.numLines
})
foundFiles.forEach(function (foundFile) {
    console.log(pad(foundFile.numLines) + ' ' + foundFile.file)
})
