function CompressedJsScript (revisions) {
    return function (parentNode, name, base) {

        var fullName = 'js/' + name + '/compressed.js'

        Element(parentNode, 'script', function (script) {
            script.type = 'text/javascript'
            script.src = base + fullName + '?' + revisions[fullName]
        })

    }
}
