function Page_infoText (parentNode, callback) {
    Element(parentNode, 'div', function (div) {
        div.className = 'page-infoText'
        callback(div)
    })
}
