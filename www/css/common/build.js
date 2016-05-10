#!/usr/bin/env node
process.chdir(__dirname)
var CompressCssFiles = require('../../js/CompressCssFiles.js')
CompressCssFiles([
    'defaults', 'common', 'logoLink', 'page', 'page-tags',
    'textList', 'form', 'form-button', 'form-textfield', 'form-component',
    'form-select', 'form-datefield', 'form-property',
    'form-value', 'form-captcha', 'clickable', 'battery',
    'form-checkbox', 'tab', 'topLink', 'filterBar', 'imageText',
    'thumbnail_link', 'image_link', 'panel', 'title_and_description',
    'tag', 'twoColumns', 'source_code', 'preview', 'navigation',
    'rightButton', 'removableItem', 'colorText', 'newItemButton',
    'search_form', 'textAndButtons', 'thumbnails', 'page_tabs',
])
