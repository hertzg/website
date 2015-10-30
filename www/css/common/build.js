#!/usr/bin/env node
process.chdir(__dirname)
var CompressCssFiles = require('../../js/CompressCssFiles.js')
CompressCssFiles([
    'defaults', 'common', 'logoLink', 'page', 'page-tags',
    'textList', 'form', 'form-textfield', 'form-select',
    'form-property', 'form-value', 'form-captcha', 'clickable',
    'form-checkbox', 'tab', 'topLink', 'filterBar', 'imageText',
    'image_link', 'panel', 'title_and_description', 'tag',
    'twoColumns', 'source_code', 'preview', 'navigation',
    'rightButton', 'removableItem', 'removableTextItem',
    'newItemButton', 'search_form', 'textAndButtons',
])
