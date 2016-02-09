(function () {
function compressed_css_link (parentNode, revisions, name, base, className) {

    var fullName = 'css/' + name + '/compressed.css'

    Element(parentNode, 'link', function (link) {
        link.rel = 'stylesheet'
        link.type = 'text/css'
        link.href = base + fullName + '?' + revisions[fullName]
        if (className !== undefined) link.className = className
    })

}
;
function compressed_js_script (parentNode, revisions, name, base, className) {

    var fullName = 'js/' + name + '/compressed.js'

    Element(parentNode, 'script', function (script) {
        script.type = 'text/javascript'
        script.defer = true
        script.src = base + fullName + '?' + revisions[fullName]
        if (className !== undefined) script.className = className
    })

}
;
function Element (parentNode, tagName, callback) {
    var element = document.createElement(tagName)
    parentNode.appendChild(element)
    callback(element)
}
;
function guest_page (body, base, options) {
    page(body, null, base, options)
}
;
function Hr (parentNode) {
    var div = document.createElement('div')
    div.className = 'hr'
    parentNode.appendChild(div)
}
;
var page = (function (defaultThemeColor, revisions) {
    return function (body, user, base, options) {

        if (options === undefined) options = {}

        var themeColor
        if (user) themeColor = user.theme_color
        else themeColor = defaultThemeColor

        Element(body, 'div', function (div) {
            div.id = 'tbar'
            Element(div, 'div', function (div) {
                div.id = 'tbar-limit'
                Element(div, 'a', function (a) {

                    var logoHref = options.logoHref
                    if (logoHref === undefined) logoHref = base

                    a.className = 'topLink logoLink'
                    a.href = logoHref

                    Element(a, 'img', function (img) {
                        var url = 'theme/color/' + themeColor + '/images/zvini.svg'
                        img.alt = 'Zvini'
                        img.className = 'logoLink-img'
                        img.src = base + url + '?' + revisions[url]
                    })

                })
                Element(div, 'div', function (div) {
                    div.className = 'page-clockWrapper'
                })
                if (user) {
                    Element(div, 'div', function (div) {
                        div.className = 'pageTopRightLinks'
                        Element(div, 'a', function (a) {
                            a.id = 'signOutLink'
                            a.className = 'topLink'
                            a.href = base + 'sign-out/'
                            Text(a, 'Sign Out')
                        })
                    })
                }
            })
            compressed_js_script(div, revisions, 'batteryAndClock', base)
            compressed_js_script(div, revisions, 'lineSizeRounding', base)
        })

    }
})(defaultThemeColor, revisions)
;
function public_page (body, user, base, options) {
    if (user) {
        if (options === undefined) options = {}
        options.logoHref = base + 'home/'
    }
    page(body, user, base, options)
}
;
function Text (element, text) {
    element.appendChild(document.createTextNode(text))
}
;
function title_and_description (parentNode, title, description) {
    Element(parentNode, 'span', function (span) {
        span.className = 'title_and_description'
        Element(span, 'span', function (span) {
            span.className = 'title_and_description-title'
            Text(span, title)
        })
        ZeroHeightBr(span)
        Element(span, 'span', function (span) {
            span.className = 'title_and_description-description colorText grey'
            Text(span, description)
        })
    })
}
;
function ZeroHeightBr (parentNode) {
    Element(parentNode, 'br', function (br) {
        br.className = 'zeroHeight'
    })
}
;
function Form_association (parentNode, valueCallback, propertyCallback) {
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
function Form_captcha (parentNode, base, autofocus) {
    if (autofocus === undefined) autofocus = false
    Element(parentNode, 'div', function (div) {
        div.className = 'form-captcha'
        Element(div, 'img', function (img) {
            img.alt = 'CAPTCHA'
            img.className = 'form-captcha-image'
            img.src = base + 'captcha/'
        })
    })
    Form_textfield(parentNode, 'captcha', 'Verification', {
        required: true,
        autofocus: autofocus,
    })
    Form_notes(parentNode, [
        'Enter the characters shown on the image above.',
        'This proves that you are a human and not a robot.',
    ])
    Hr(parentNode)
}
;
function Form_checkbox (parentNode, name, text, checked) {
    Element(parentNode, 'div', function (div) {
        div.className = 'form-checkbox transformable'
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
;
function Form_hidden (parentNode, name, value) {
    Element(parentNode, 'input', function (input) {
        input.type = 'hidden'
        input.name = name
        input.value = value
    })
}
;
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
;
function Form_password (parentNode, name, text, options) {
    options.type = 'password'
    Form_textfield(parentNode, name, text, options)
}
;
function Form_textarea (parentNode, name, text, options) {
    Form_association(parentNode, function (div) {
        Element(div, 'textarea', function (textarea) {

            var value = options.value
            if (value !== undefined && value !== '') textarea.value = value

            var maxlength = options.maxlength
            if (maxlength !== undefined) textarea.maxLength = maxlength

            var autofocus = options.autofocus
            if (autofocus === true) {
                textarea.autofocus = autofocus
                textarea.focus()
            }

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
;
function Form_textfield (parentNode, name, text, options) {
    Form_association(parentNode, function (div) {
        Element(div, 'input', function (input) {

            var type = options.type
            if (type === undefined) type = 'text'

            var value = options.value
            if (value !== undefined && value !== '') input.value = value

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
function Page_errors (parentNode, texts) {
    Page_textList(parentNode, texts, 'errors')
}
;
function Page_imageArrowLink (parentNode,
    title, href, iconName, options, callback) {

    options.className = 'withArrow'
    Page_imageLink(parentNode, title, href, iconName, options, callback)

}

;
function Page_imageArrowLinkWithDescription (parentNode,
    title, description, href, iconName, options, callback) {

    if (options === undefined) options = {}
    options.className = 'withArrow'

    Page_imageLink(parentNode, function (span) {
        title_and_description(span, title, description)
    }, href, iconName, options, callback)

}
;
function Page_imageLink (parentNode, titleOrCallback, href, iconName, options) {

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
            if (typeof titleOrCallback === 'string') Text(span, titleOrCallback)
            else titleOrCallback(span)
        })

    })

}
;
function Page_infoText (parentNode, callback) {
    Element(parentNode, 'div', function (div) {
        div.className = 'page-infoText'
        callback(div)
    })
}
;
function Page_messages (parentNode, texts) {
    Page_textList(parentNode, texts, 'messages')
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
function Page_phishingWarning (parentNode, absoluteBase) {
    Page_infoText(parentNode, function (div) {
        Text(div, 'You are accessing "')
        Element(div, 'code', function (code) {
            Text(code, absoluteBase)
        })
        Text(div, '". The address in your browser\'s' +
            ' address bar should start with it.')
    })
}
;
function Page_sessionErrors (parentNode, errors) {
    if (errors === undefined) return
    Page_errors(parentNode, errors)
}
;
function Page_sessionMessages (parentNode, messages) {
    if (messages === undefined) return
    Page_messages(parentNode, messages)
}
;
function Page_textList (parentNode, texts, className) {
    Element(parentNode, 'div', function (div) {
        div.className = 'textList ' + className
        Element(div, 'ul', function (ul) {
            ul.className = 'textList-list'
            if (texts.length === 1) {
                Element(ul, 'li', function (li) {
                    li.className = 'textList-list-item'
                    li.innerHTML = texts[0]
                })
            } else {
                texts.forEach(function (text) {
                    Element(ul, 'li', function (li) {
                        li.className = 'textList-list-item'
                        Element(li, 'span', function (span) {
                            span.className = 'textList-list-item-bullet ' + className
                        })
                        li.innerHTML += text
                    })
                })
            }
        })
    })
}
;
function Page_title (parentNode, title, callback) {
    ZeroHeightBr(parentNode)
    Element(parentNode, 'div', function (div) {
        div.className = 'tab'
        Element(div, 'div', function (div) {
            div.className = 'tab-bar'
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
function Page_warnings (parentNode, texts) {
    Page_textList(parentNode, texts, 'warnings')
}
;
window.ui = {
    compressed_css_link: compressed_css_link,
    compressed_js_script: compressed_js_script,
    Element: Element,
    Form_button: Form_button,
    Form_captcha: Form_captcha,
    Form_checkbox: Form_checkbox,
    Form_hidden: Form_hidden,
    Form_notes: Form_notes,
    Form_password: Form_password,
    Form_textarea: Form_textarea,
    Form_textfield: Form_textfield,
    guest_page: guest_page,
    Hr: Hr,
    page: page,
    Page_create: Page_create,
    Page_emptyTabs: Page_emptyTabs,
    Page_imageArrowLink: Page_imageArrowLink,
    Page_imageArrowLinkWithDescription: Page_imageArrowLinkWithDescription,
    Page_imageLink: Page_imageLink,
    Page_infoText: Page_infoText,
    Page_panel: Page_panel,
    Page_phishingWarning: Page_phishingWarning,
    Page_sessionErrors: Page_sessionErrors,
    Page_sessionMessages: Page_sessionMessages,
    Page_textList: Page_textList,
    Page_title: Page_title,
    Page_twoColumns: Page_twoColumns,
    Page_warnings: Page_warnings,
    public_page: public_page,
    Text: Text,
    ZeroHeightBr: ZeroHeightBr,
}
;

})()