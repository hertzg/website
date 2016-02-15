function Page_thumbnailLinkWithDescription (parentNode,
    title, descriptionCallback, href, iconName, options) {

    create_thumbnail_link(parentNode, function (div) {
        Element(div, 'span', function (span) {
            span.className = 'thumbnail_link-title'
            Text(span, title)
        })
        ZeroHeightBr(div)
        Element(div, 'span', function (span) {
            span.className = 'thumbnail_link-description'
            descriptionCallback(span)
        })
    }, href, iconName, options)

}
