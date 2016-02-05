#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../CompressJsFiles.js')
CompressJsFiles([
    'Element', 'Form_association', 'Form_button', 'Form_textarea', 'Hr',
    'Page_create', 'Page_emptyTabs', 'Page_imageArrowLink',
    'Page_imageLink', 'Page_panel', 'Page_twoColumns',
    'Text', 'ZeroHeightBr', 'main',
])
