function Page_emptyTabs (parentNode, callback) {
    ZeroHeightBr(parentNode, 'div')
    Element(parentNode, 'div', function (div) {
        div.className = 'tab-content'
        callback(div)
    })
}
