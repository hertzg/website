#!/usr/bin/env node

process.chdir(__dirname)

var fs = require('fs'),
    uglifyCss = require('uglifycss')

var source = fs.readFileSync('confirmDialog.css', 'utf-8')

var compressCss = uglifyCss.processString(source)
fs.writeFileSync('compressed.css', compressCss)
