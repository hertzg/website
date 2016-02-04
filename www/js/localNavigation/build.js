#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../CompressJsFiles.js')
CompressJsFiles(['AbsoluteBase', 'LoadPage', 'LoadScript', 'main'])
