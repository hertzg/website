function CompressedJsScript (revisions) {
    return function (parentNode, name, base, className) {

        var fullName = 'js/' + name + '/compressed.js'

        Element(parentNode, 'script', function (script) {
            script.type = 'text/javascript'
            script.defer = true
            script.src = base + fullName + '?' + revisions[fullName]
            if (className !== undefined) script.className = className
        })

    }
}