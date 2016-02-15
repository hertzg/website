function Page_thumbnailLink (parentNode, title, href, iconName, options) {
    create_thumbnail_link(parentNode, function (div) {
        Element(div, 'span', function (span) {
            span.className = 'thumbnail_link-title'
            Text(span, title)
        })
    }, href, iconName, options)
}
