function Form_select (parentNode, name, text, options, value, autofocus) {
    Form_association(parentNode, function (div) {
        Element(div, 'select', function (select) {
            select.className = 'form-select'
            select.name = select.id = name
            if (autofocus === true) {
                select.autofocus = true
                select.focus()
            }
            options.forEach(function (item) {
                ui.Element(select, 'option', function (option) {
                    option.value = item.key
                    ui.Text(option, item.value)
                    if (String(value) === item.key) option.selected = true
                })
            })
        })
    }, function (div) {
        Element(div, 'label', function (label) {
            label.className = 'form-property-label'
            label.htmlFor = name
            ui.Text(label, text + ':')
        })
    })
}
