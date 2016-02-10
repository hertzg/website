#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../CompressJsFiles.js')
CompressJsFiles([
    '../DateAgo',
    'compressed_css_link',
    'compressed_js_script',
    'Element',
    'export_date_ago',
    'guest_page',
    'Hr',
    'page',
    'public_page',
    'Text',
    'title_and_description',
    'ZeroHeightBr',
    'Form/association',
    'Form/button',
    'Form/captcha',
    'Form/checkbox',
    'Form/hidden',
    'Form/label',
    'Form/notes',
    'Form/password',
    'Form/textarea',
    'Form/textfield',
    'Page/create',
    'Page/emptyTabs',
    'Page/errors',
    'Page/imageArrowLink',
    'Page/imageArrowLinkWithDescription',
    'Page/imageLink',
    'Page/imageLinkWithDescription',
    'Page/infoText',
    'Page/messages',
    'Page/panel',
    'Page/phishingWarning',
    'Page/sessionErrors',
    'Page/sessionMessages',
    'Page/text',
    'Page/textList',
    'Page/title',
    'Page/twoColumns',
    'Page/warnings',
    'main',
])