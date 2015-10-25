#!/usr/bin/env node
process.chdir(__dirname)
var CompressCssFiles = require('../../js/CompressCssFiles.js')
CompressCssFiles(['other', 'buttonsWrapper', 'buttonWrapper'])
