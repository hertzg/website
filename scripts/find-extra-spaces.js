#!/usr/bin/env node

function scan (dir) {
    var files = fs.readdirSync(dir)
    files.forEach(function (file) {

        if (/^\./.test(file)) return

        file = dir + '/' + file

        if (/\.(css|js|php|sh)$/.test(file) &&
            !(/\.(combined|compressed)\.(css|js)$/.test(file))) {

            var content = fs.readFileSync(file, 'utf8')
            if (content.match(/[^\n ] {2,}/)) {
                foundFiles.push({
                    file: file.substr(2),
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
foundFiles.forEach(function (foundFile) {
    console.log(foundFile.file)
})
