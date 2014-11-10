#!/usr/bin/env node

process.chdir(__dirname)

var fs = require('fs'),
    uglifyCss = require('uglifycss')

var files = ['common', 'steps', 'page', 'wizard',
    'field_columns', 'textfield', 'button', 'backgroundGradient']

var source = ''
files.forEach(function (file) {
    source += fs.readFileSync(file + '.css', 'utf-8') + '\n'
})

var compressCss = uglifyCss.processString(source)
fs.writeFileSync('compressed.css', compressCss)
