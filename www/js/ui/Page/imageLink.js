function Page_imageLink (parentNode, callback, href, iconName, options) {

    if (options === undefined) options = {}

    var id = options.id
    if (id !== undefined) {
        Element(parentNode, 'a', function (a) {
            a.name = id
        })
    }
    Element(parentNode, 'a', function (a) {

        var additionalClass
        var className = options.className
        if (className === undefined) additionalClass = ''
        else additionalClass = ' ' + className
        if (options.localNavigation !== undefined) {
            additionalClass += ' localNavigation-link'
        }

        if (id !== undefined) a.id = id
        a.className = 'clickable link image_link' + additionalClass
        a.href = href

        Element(a, 'span', function (span) {
            span.className = 'image_link-icon'
            Element(span, 'span', function (span) {
                span.className = 'icon ' + iconName
            })
        })
        Element(a, 'span', function (span) {
            span.className = 'image_link-content'
            callback(span)
        })

    })

}
