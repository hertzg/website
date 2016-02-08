function compressed_css_link (parentNode, revisions, name, base, className) {

    var fullName = 'css/' + name + '/compressed.css'

    Element(parentNode, 'link', function (link) {
        link.rel = 'stylesheet'
        link.type = 'text/css'
        link.href = base + fullName + '?' + revisions[fullName]
        if (className !== undefined) link.className = className
    })

}
