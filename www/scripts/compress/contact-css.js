#!/usr/bin/env node

process.chdir(__dirname)
process.chdir('../..')

var fs = require('fs'),
    uglifyCss = require('uglifycss')

var files = [
    'contactPanel.css',
]

var source = ''
files.forEach(function (file) {
    source += fs.readFileSync('css/contact/' + file, 'utf-8') + '\n'
})

var compressCss = uglifyCss.processString(source)
fs.writeFileSync('contact.compressed.css', compressCss)
