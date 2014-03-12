#!/usr/bin/env node

process.chdir(__dirname)
process.chdir('..')

var fs = require('fs'),
    uglifyCss = require('uglifycss')

var files = [
    'other.css',
    'buttonsWrapper.css',
    'buttonWrapper.css',
]

var source = ''
files.forEach(function (file) {
    source += fs.readFileSync('css/index/' + file, 'utf-8') + '\n'
})

var compressCss = uglifyCss.processString(source)
fs.writeFileSync('index.compressed.css', compressCss)
