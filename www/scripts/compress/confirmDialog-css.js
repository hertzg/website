#!/usr/bin/env node

process.chdir(__dirname)
process.chdir('../..')

var fs = require('fs'),
    uglifyCss = require('uglifycss')

var files = [
    'confirmDialog.css',
]

var source = ''
files.forEach(function (file) {
    source += fs.readFileSync('css/confirmDialog/' + file, 'utf-8') + '\n'
})

var compressCss = uglifyCss.processString(source)
fs.writeFileSync('confirmDialog.compressed.css', compressCss)
