#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../CompressJsFiles.js')
CompressJsFiles([
    '../DateAgo',
    'AdminPage',
    'BuildQuery',
    'CompressedCssLink',
    'CompressedJsScript',
    'create_thumbnail_link',
    'Element',
    'export_date_ago',
    'GuestPage',
    'Hr',
    'Page',
    'PublicPage',
    'Text',
    'title_and_description',
    'UserPage',
    'ZeroHeightBr',
    'Form/association',
    'Form/button',
    'Form/captcha',
    'Form/checkbox',
    'Form/checkboxItem',
    'Form/hidden',
    'Form/label',
    'Form/notes',
    'Form/password',
    'Form/select',
    'Form/textarea',
    'Form/textfield',
    'ItemList/listUrl',
    'ItemList/pageHiddenInputs',
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
    'Page/thumbnailLink',
    'Page/thumbnailLinkWithDescription',
    'Page/thumbnails',
    'Page/title',
    'Page/twoColumns',
    'Page/warnings',
    'SearchForm/create',
    'SearchForm/emptyContent',
    'main',
])
