#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../../../../js/CompressJsFiles.js')
CompressJsFiles([
    '../../../../js/amount_text',
    '../../../js/WalletOptions',
    'main',
], '../index.js')
