function Form_label (parentNode, text, callback) {
    Form_association(parentNode, function (div) {
        Element(div, 'div', function (div) {
            div.className = 'form-label'
            callback(div)
        })
    }, function (div) {
        Element(div, 'div', function (div) {
            Text(div, text + ':')
        })
    })
}
