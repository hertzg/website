function SearchForm_create (parentNode, action, callback) {
    Element(parentNode, 'form', function (form) {
        form.action = action
        form.className = 'search_form'
        callback(form)
    })
    ZeroHeightBr(parentNode)
}
