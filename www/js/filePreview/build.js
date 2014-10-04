#!/usr/bin/env node

process.chdir(__dirname)

var fs = require('fs'),
    uglifyJs = require('uglify-js')

var source = fs.readFileSync('filePreview.js', 'utf8')

var ast = uglifyJs.parse(source)
ast.figure_out_scope()
var compressor = uglifyJs.Compressor({})
var compressedAst = ast.transform(compressor)
compressedAst.figure_out_scope()
compressedAst.compute_char_frequency()
compressedAst.mangle_names()
var compressedSource = compressedAst.print_to_string()

fs.writeFileSync('compressed.js', compressedSource)
