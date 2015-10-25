#!/usr/bin/env node
process.chdir(__dirname)
var CompressCssFiles = require('../../js/CompressCssFiles.js')
CompressCssFiles(['common', 'steps', 'page', 'wizard',
    'field_columns', 'textfield', 'button', 'backgroundGradient'])
