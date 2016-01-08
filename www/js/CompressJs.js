var uglifyJs = require('uglify-js')

module.exports = function (source) {
    var ast = uglifyJs.parse(source)
    ast.figure_out_scope()
    var compressor = uglifyJs.Compressor({})
    var compressedAst = ast.transform(compressor)
    compressedAst.figure_out_scope()
    compressedAst.compute_char_frequency()
    compressedAst.mangle_names()
    return compressedAst.print_to_string({ max_line_len: 1024 })
}
