function Page_imageLink (parentNode,
    title, href, iconName, options, callback) {

    add(parentNode, 'a', function (a) {
        a.name = options.id
    })
    add(parentNode, 'a', function (a) {

        var additionalClass
        if (options.className === undefined) additionalClass = ''
        else additionalClass = ' ' + options.className
        if (options.localNavigation !== undefined) {
            additionalClass += ' localNavigation-link'
        }

        a.id = options.id
        a.className = 'clickable link image_link' + additionalClass
        a.href = href
        add(a, 'span', function (span) {
            span.className = 'image_link-icon'
            add(span, 'span', function (span) {
                span.className = 'icon ' + iconName
            })
        })
        add(a, 'span', function (span) {
            span.className = 'image_link-content'
            addText(span, title)
        })

    })

}

