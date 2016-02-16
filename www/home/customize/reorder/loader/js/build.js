#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../../../../../js/CompressJsFiles.js')
CompressJsFiles([
    '../../../../../js/create_calendar_icon_today',
    'main',
], '../index.js')
