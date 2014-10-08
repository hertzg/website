#!/usr/bin/env node

process.chdir(__dirname)

var fs = require('fs'),
    uglifyCss = require('uglifycss')

var files = [
    'defaults', 'common', 'page', 'page-tags', 'textList', 'form',
    'form-select', 'form-property', 'form-value', 'form-captcha',
    'form-checkbox', 'clickable', 'tab', 'topLink', 'filterBar', 'imageText',
    'image_link', 'panel', 'title_and_description', 'tag', 'twoColumns',
    'php-code', 'preview', 'navigation', 'rightButton', 'removableItem',
    'newItemButton', 'search_form', 'textAndButtons',
]

var source = ''
files.forEach(function (file) {
    source += fs.readFileSync(file + '.css', 'utf-8') + '\n'
})

var compressCss = uglifyCss.processString(source)
fs.writeFileSync('compressed.css', compressCss)
