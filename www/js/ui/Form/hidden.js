function Form_hidden (parentNode, name, value) {
    Element(parentNode, 'input', function (input) {
        input.type = 'hidden'
        input.name = name
        input.value = value
    })
}
