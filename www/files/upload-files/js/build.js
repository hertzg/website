#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../../../js/CompressJsFiles.js')
CompressJsFiles(['ChunkedReader', 'Post', 'main'])
