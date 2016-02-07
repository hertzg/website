function Form_textarea (parentNode, name, text, options) {
    Form_association(parentNode, function (div) {
        Element(div, 'textarea', function (textarea) {

            var value = options.value
            if (value !== undefined) textarea.value = value

            var maxlength = options.maxlength
            if (maxlength !== undefined) textarea.maxlength = maxlength

            var autofocus = options.autofocus
            if (autofocus !== undefined) textarea.autofocus = autofocus

            var readonly = options.readonly
            if (readonly !== undefined) textarea.readOnly = readonly

            var required = options.required
            if (required !== undefined) textarea.required = required

            textarea.className = 'form-textarea'
            textarea.id = textarea.name = name

        })
    }, function (div) {
        Element(div, 'label', function (label) {
            label.className = 'form-property-label'
            label.htmlFor = name
            Text(label, text + ':')
        })
    })
}
