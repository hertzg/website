#!/usr/bin/env node

process.chdir(__dirname)
process.stdout.on('error', function () {})

require('./fns/FindSourceFiles.js')(function (file, content) {
    return content.split(/\n/).some(function (line) {
        return line.match(/^\s*/)[0].length % 4 !== 0
    })
})
