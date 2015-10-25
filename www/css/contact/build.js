#!/usr/bin/env node
process.chdir(__dirname)
var CompressCssFiles = require('../../js/CompressCssFiles.js')
CompressCssFiles(['contactPanel'])
