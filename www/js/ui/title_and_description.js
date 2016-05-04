function title_and_description (parentNode,
    titleCallback, descriptionCallback) {

    Element(parentNode, 'span', function (span) {
        span.className = 'title_and_description'
        Element(span, 'span', function (span) {
            span.className = 'title_and_description-title'
            titleCallback(span)
        })
        ZeroHeightBr(span, 'span')
        Element(span, 'span', function (span) {
            span.className = 'title_and_description-description colorText grey'
            descriptionCallback(span)
        })
    })

}
