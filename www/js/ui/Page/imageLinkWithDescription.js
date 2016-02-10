function Page_imageLinkWithDescription (parentNode,
    titleCallback, descriptionCallback, href, iconName, options) {

    Page_imageLink(parentNode, function (span) {
        title_and_description(span, titleCallback, descriptionCallback)
    }, href, iconName, options)

}
