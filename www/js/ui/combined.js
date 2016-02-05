(function () {
function Element (parentNode, tagName, callback) {
    var element = document.createElement(tagName)
    parentNode.appendChild(element)
    callback(element)
}
;
function Form_association (parentNode, propertyCallback, valueCallback) {
    Element(parentNode, 'div', function (div) {
        div.className = 'form-item'
        Element(div, 'div', function (div) {
            div.className = 'form-property'
            propertyCallback(div)
        })
        Element(div, 'div', function (div) {
            div.className = 'form-value'
            valueCallback(div)
        })
    })
}
;
function Form_button (parentNode, text, name) {
    Element(parentNode, 'input', function (input) {
        input.className = 'clickable form-button'
        input.type = 'submit'
        input.value = text
        if (name !== undefined) input.name = name
    })
}
;
function Form_textarea (parentNode, name, text, options) {
    Form_association(parentNode, function (div) {
        Element(div, 'label', function (label) {
            label.className = 'form-property-label'
            label.htmlFor = name
            Text(label, text + ':')
        })
    }, function (div) {
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
    })
    if (options.value !== undefined) {
        
    }
}
;
function Hr (parentNode) {
    var div = document.createElement('div')
    div.className = 'hr'
    parentNode.appendChild(div)
}
;
function Page_create (parentNode, backlink, title, callback) {
    ZeroHeightBr(parentNode)
    Element(parentNode, 'div', function (div) {
        div.className = 'tab'
        Element(div, 'div', function (div) {
            div.className = 'tab-bar'
            Element(div, 'a', function (a) {
                a.className = 'clickable tab-normal localNavigation-link'
                a.href = backlink.href
                Text(a, '\xab ' + backlink.title)
            })
            Element(div, 'span', function (span) {
                span.className = 'tab-active limited'
                Element(span, 'span', function (span) {
                    span.className = 'zeroSize'
                    Text(span, ' \xbb ')
                })
                Text(span, title)
            })
        })
    })
    ZeroHeightBr(parentNode)
    Element(parentNode, 'div', function (div) {
        div.className = 'tab-content'
        callback(div)
    })
}
;
function Page_emptyTabs (parentNode, callback) {
    ZeroHeightBr(parentNode)
    Element(parentNode, 'div', function (div) {
        div.className = 'tab-content'
        callback(div)
    })
}
;
function Page_imageArrowLink (parentNode,
    title, href, iconName, options, callback) {

    options.className = 'withArrow'
    Page_imageLink(parentNode, title, href, iconName, options, callback)

}
;
function Page_imageLink (parentNode, title, href, iconName, options, callback) {

    Element(parentNode, 'a', function (a) {
        a.name = options.id
    })
    Element(parentNode, 'a', function (a) {

        var additionalClass
        var className = options.className
        if (className === undefined) additionalClass = ''
        else additionalClass = ' ' + className
        if (options.localNavigation !== undefined) {
            additionalClass += ' localNavigation-link'
        }

        a.id = options.id
        a.className = 'clickable link image_link' + additionalClass
        a.href = href

        Element(a, 'span', function (span) {
            span.className = 'image_link-icon'
            Element(span, 'span', function (span) {
                span.className = 'icon ' + iconName
            })
        })
        Element(a, 'span', function (span) {
            span.className = 'image_link-content'
            Text(span, title)
        })

    })

}
;
function Page_panel (parentNode, title, callback) {
    ZeroHeightBr(parentNode)
    Element(parentNode, 'div', function (div) {
        div.className = 'panel'
        Element(div, 'div', function (div) {
            div.className = 'panel-title'
            Element(div, 'div', function (div) {
                div.className = 'panel-title-text'
                Text(div, title)
                Element(div, 'span', function (span) {
                    span.className = 'zeroSize'
                    Text(span, ':')
                })
            })
        })
        Element(div, 'div', function (div) {
            div.className = 'panel-content'
            callback(div)
        })
    })
}
;
function Page_twoColumns (parentNode, column1Callback, column2Callback) {
    Element(parentNode, 'div', function (div) {
        div.className = 'twoColumns'
        Element(div, 'div', function (div) {
            div.className = 'twoColumns-column1 dynamic'
            column1Callback(div)
        })
        Element(div, 'div', function (div) {
            div.className = 'twoColumns-column2 dynamic'
            column2Callback(div)
        })
    })
}
;
function Text (element, text) {
    element.appendChild(document.createTextNode(text))
}
;
function ZeroHeightBr (parentNode) {
    Element(parentNode, 'br', function (br) {
        br.className = 'zeroHeight'
    })
}
;
window.ui = {
    Element: Element,
    Form_button: Form_button,
    Form_textarea: Form_textarea,
    Hr: Hr,
    Page_create: Page_create,
    Page_emptyTabs: Page_emptyTabs,
    Page_imageArrowLink: Page_imageArrowLink,
    Page_imageLink: Page_imageLink,
    Page_panel: Page_panel,
    Page_twoColumns: Page_twoColumns,
    Text: Text,
    ZeroHeightBr: ZeroHeightBr,
}
;

})()