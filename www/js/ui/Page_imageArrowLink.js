function Page_imageArrowLink (parentNode,
    title, href, iconName, options, callback) {

    options.className = 'withArrow'
    Page_imageLink(parentNode, title, href, iconName, options, callback)

}
