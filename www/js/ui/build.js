#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../CompressJsFiles.js')
CompressJsFiles([
    'Element', 'Hr', 'Page_create', 'Page_emptyTabs', 'Page_imageArrowLink',
    'Page_imageLink', 'Page_panel', 'Page_twoColumns',
    'Text', 'ZeroHeightBr', 'main',
])
