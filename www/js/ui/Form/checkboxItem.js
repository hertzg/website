function Form_checkboxItem (parentNode, name, text, checked) {
    Element(parentNode, 'div', function (div) {
        div.className = 'form-checkbox item transformable'
        Element(div, 'label', function (label) {
            label.className = 'form-checkbox-label clickable'
            Element(label, 'span', function (span) {
                span.className = 'form-checkbox-inputWrapper'
                Element(span, 'input', function (input) {
                    input.className = 'form-checkbox-input'
                    input.type = 'checkbox'
                    input.id = input.name = name
                    if (checked === true) input.checked = true
                })
            })
            Text(label, text)
        })
    })
}
