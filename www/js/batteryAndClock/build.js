#!/usr/bin/env node

process.chdir(__dirname)

var fs = require('fs'),
    uglifyJs = require('uglify-js')

var files = ['battery', 'clock']

var source = '(function () {\n'
files.forEach(function (file) {
    source += fs.readFileSync(file + '.js', 'utf8') + ';\n'
})
source += '\n})()'

var ast = uglifyJs.parse(source)
ast.figure_out_scope()
var compressor = uglifyJs.Compressor({})
var compressedAst = ast.transform(compressor)
compressedAst.figure_out_scope()
compressedAst.compute_char_frequency()
compressedAst.mangle_names()
var compressedSource = compressedAst.print_to_string()

fs.writeFileSync('combined.js', source)
fs.writeFileSync('compressed.js', compressedSource)
