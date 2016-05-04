function Page_title (parentNode, title, callback) {
    ZeroHeightBr(parentNode, 'div')
    Element(parentNode, 'div', function (div) {
        div.className = 'tab'
        Element(div, 'div', function (div) {
            div.className = 'tab-bar'
            Element(div, 'span', function (span) {
                span.className = 'tab-active'
                Element(span, 'span', function (span) {
                    span.className = 'zeroSize'
                    Text(span, ' \xbb ')
                })
                Text(span, title)
            })
        })
    })
    ZeroHeightBr(parentNode, 'div')
    Element(parentNode, 'div', function (div) {
        div.className = 'tab-content'
        callback(div)
    })
}
