#!/usr/bin/env node

process.chdir(__dirname)
process.chdir('..')

var fs = require('fs'),
    uglifyCss = require('uglifycss')

var files = [
    'css/defaults.css',
    'css/common.css',
    'css/textList.css',
    'css/form.css',
    'css/form-checkbox.css',
    'css/clickable.css',
    'css/tab.css',
    'css/topLink.css',
    'css/filterBar.css',
    'css/imageText.css',
    'css/image_link.css',
    'css/panel.css',
    'css/title_and_description.css',
    'css/clearSearchKeywordButton.css',
    'css/search_form.css',
    'css/searchButton.css',
    'css/tag.css',
]

var source = ''
files.forEach(function (file) {
    source += fs.readFileSync(file, 'utf-8') + '\n'
})

var compressCss = uglifyCss.processString(source)
fs.writeFileSync('common.compressed.css', compressCss)
