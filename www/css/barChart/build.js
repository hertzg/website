#!/usr/bin/env node
process.chdir(__dirname)
var CompressCssFiles = require('../../js/CompressCssFiles.js')
CompressCssFiles(['barChart', 'barChart-bar',
    'barChart-sizer', 'barChart-lineLabels', 'barChart-value'])
