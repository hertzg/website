function Page_text (parentNode, callback) {
    Element(parentNode, 'div', function (div) {
        div.className = 'page-text'
        callback(div)
    })
}
