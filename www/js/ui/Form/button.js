function Form_button (parentNode, text, name) {
    var className = name === undefined ? 'green' : 'not_green'
    Element(parentNode, 'div', function (div) {
        div.className = 'form-button ' + className
        Element(div, 'input', function (input) {
            input.className = 'form-button-button ' + className
            input.type = 'submit'
            input.value = text
            if (name !== undefined) input.name = name
        })
    })
}
