#!/usr/bin/env node
process.chdir(__dirname)
var CompressJsFiles = require('../CompressJsFiles.js')
CompressJsFiles([
    '../LoadScript',
    'FocusTarget',
    'LoadData',
    'ScanLinks',
    'UnloadPage',
    'main',
])
