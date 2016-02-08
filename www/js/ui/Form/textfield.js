function Form_textfield (parentNode, name, text, options) {
    Form_association(parentNode, function (div) {
        Element(div, 'input', function (input) {

            var type = options.type
            if (type === undefined) type = 'text'

            var value = options.value
            if (value !== undefined) input.value = value

            var maxlength = options.maxlength
            if (maxlength !== undefined) input.maxLength = maxlength

            var autofocus = options.autofocus
            if (autofocus === true) {
                input.autofocus = autofocus
                input.focus()
            }

            var readonly = options.readonly
            if (readonly !== undefined) input.readOnly = readonly

            var required = options.required
            if (required !== undefined) input.required = required

            input.type = type
            input.className = 'form-textfield'
            input.id = input.name = name

        })
    }, function (div) {
        Element(div, 'label', function (label) {
            label.className = 'form-property-label'
            label.htmlFor = name
            Text(label, text + ':')
        })
    })
}
