#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../CompressJsFiles.js')
CompressJsFiles([
    'Element',
    'guest_page',
    'Hr',
    'Text',
    'title_and_description',
    'ZeroHeightBr',
    'Form/association',
    'Form/button',
    'Form/captcha',
    'Form/notes',
    'Form/password',
    'Form/textarea',
    'Form/textfield',
    'Page/create',
    'Page/emptyTabs',
    'Page/imageArrowLink',
    'Page/imageArrowLinkWithDescription',
    'Page/imageLink',
    'Page/panel',
    'Page/title',
    'Page/twoColumns',
    'main',
])
