function Form_notes (parentNode, notes) {
    Form_association(parentNode, function (div) {
        Element(div, 'ul', function (ul) {
            ul.className = 'form-notes'
            notes.forEach(function (note) {
                Element(ul, 'li', function (li) {
                    li.className = 'form-notes-item'
                    Element(li, 'span', function (span) {
                        span.className = 'form-notes-item-bullet'
                    })
                    Text(li, note)
                })
            })
        })
    }, function () {})
}
