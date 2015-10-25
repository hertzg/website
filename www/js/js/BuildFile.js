var fs = require('fs'),
    uglifyJs = require('uglify-js')

module.exports = function (file) {

    var source = fs.readFileSync(file + '.js', 'utf8')

    var ast = uglifyJs.parse(source)
    ast.figure_out_scope()
    var compressor = uglifyJs.Compressor({})
    var compressedAst = ast.transform(compressor)
    compressedAst.figure_out_scope()
    compressedAst.compute_char_frequency()
    compressedAst.mangle_names()
    var compressedSource = compressedAst.print_to_string()

    fs.writeFileSync('compressed.js', compressedSource)

}
