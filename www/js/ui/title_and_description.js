function title_and_description (parentNode, title, description) {
    Element(parentNode, 'span', function (span) {
        span.className = 'title_and_description'
        Element(span, 'span', function (span) {
            span.className = 'title_and_description-title'
            Text(span, title)
        })
        ZeroHeightBr(span)
        Element(span, 'span', function (span) {
            span.className = 'title_and_description-description colorText grey'
            Text(span, description)
        })
    })
}
