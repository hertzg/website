#!/usr/bin/env node

process.chdir(__dirname)
process.stdout.on('error', function () {})

require('./fns/FindSourceFiles.js')(function (file, content) {
    return content.match(/\n{3}/)
})
