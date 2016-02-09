function Page_imageArrowLinkWithDescription (parentNode,
    titleCallback, descriptionCallback, href, iconName, options) {

    if (options === undefined) options = {}
    options.className = 'withArrow'

    Page_imageLink(parentNode, function (span) {
        title_and_description(span, titleCallback, descriptionCallback)
    }, href, iconName, options)

}
