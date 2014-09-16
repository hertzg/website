#!/usr/bin/env node

process.chdir(__dirname)
process.chdir('../..')

var fs = require('fs'),
    uglifyCss = require('uglifycss')

var files = [
    'defaults.css',
    'common.css',
    'page.css',
    'page-tags.css',
    'textList.css',
    'form.css',
    'form-select.css',
    'form-property.css',
    'form-value.css',
    'form-captcha.css',
    'form-checkbox.css',
    'clickable.css',
    'tab.css',
    'topLink.css',
    'filterBar.css',
    'imageText.css',
    'image_link.css',
    'panel.css',
    'title_and_description.css',
    'search_form.css',
    'searchButton.css',
    'tag.css',
    'twoColumns.css',
    'php-code.css',
    'preview.css',
    'navigation.css',
    'rightButton.css',
    'removableItem.css',
    'newItemButton.css',
]

var source = ''
files.forEach(function (file) {
    source += fs.readFileSync('css/common/' + file, 'utf-8') + '\n'
})

var compressCss = uglifyCss.processString(source)
fs.writeFileSync('common.compressed.css', compressCss)
