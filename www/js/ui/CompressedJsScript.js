function CompressedJsScript (revisions) {
    return function (name, base) {
        var fullName = 'js/' + name + '/compressed.js'
        return base + fullName + '?' + revisions[fullName]
    }
}
