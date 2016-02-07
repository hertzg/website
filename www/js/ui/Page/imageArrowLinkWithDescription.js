function Page_imageArrowLinkWithDescription (parentNode,
    title, description, href, iconName, options, callback) {

    options.className = 'withArrow'
    Page_imageLink(parentNode, function (span) {
        title_and_description(span, title, description)
    }, href, iconName, options, callback)

}
