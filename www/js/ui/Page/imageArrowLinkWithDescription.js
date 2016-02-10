function Page_imageArrowLinkWithDescription (parentNode,
    titleCallback, descriptionCallback, href, iconName, options) {

    if (options === undefined) options = {}
    options.className = 'withArrow'

    Page_imageLinkWithDescription(parentNode, titleCallback,
        descriptionCallback, href, iconName, options)

}
