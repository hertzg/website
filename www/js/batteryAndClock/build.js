#!/usr/bin/env node
process.chdir(__dirname)
var BuildFiles = require('../js/BuildFiles.js')
BuildFiles(['Battery', 'Clock', 'main'])
