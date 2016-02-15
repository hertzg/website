function SearchForm_emptyContent (parentNode, placeholder) {
    Element(parentNode, 'span', function (span) {
        span.className = 'search_form-content empty'
        Element(span, 'input', function (input) {
            input.className = 'form-textfield'
            input.type = 'text'
            input.name = 'keyword'
            input.required = true
            input.placeholder = placeholder
        })
    })
    Element(parentNode, 'button', function (button) {
        button.title = 'Search'
        button.className = 'search_form-button rightButton clickable'
        Element(button, 'span', function (span) {
            span.className = 'rightButton-icon icon search'
        })
        Element(button, 'span', function (span) {
            span.className = 'displayNone'
            Text(span, 'Search')
        })
    })
}
