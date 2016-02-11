function Page (localNavigation, revisions,
    compressed_css_link, compressed_js_script) {

    var head = document.head,
        body = document.body

    return function (response, base, callback, options) {

        if (options === undefined) options = {}

        var user = response.user

        window.base = base
        window.time = response.time
        window.timezone = response.timezone
        localNavigation.onUnload(function () {
            delete window.base
            delete window.time
            delete window.timezone
        })

        var headCallback = options.head
        if (headCallback !== undefined) headCallback(head)

        if (user) {
            compressed_css_link(head, 'confirmDialog', base)
        }

        Element(body, 'div', function (div) {
            div.id = 'tbar'
            Element(div, 'div', function (div) {
                div.id = 'tbar-limit'
                Element(div, 'a', function (a) {

                    var href = options.logoHref
                    var className = 'topLink logoLink'
                    if (href === undefined) {
                        href = base
                        className += ' localNavigation-link'
                    }

                    a.href = href
                    a.className = className

                    Element(a, 'img', function (img) {
                        var url = 'theme/color/' + response.themeColor + '/images/zvini.svg'
                        img.alt = 'Zvini'
                        img.className = 'logoLink-img'
                        img.src = base + url + '?' + revisions[url]
                    })

                })
                Element(div, 'div', function (div) {
                    div.className = 'page-clockWrapper'
                    Element(div, 'div', function (div) {
                        div.id = 'staticClockWrapper'
                    })
                    Element(div, 'div', function (div) {
                        div.id = 'batteryWrapper'
                    })
                    Element(div, 'div', function (div) {
                        div.id = 'dynamicClockWrapper'
                    })
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
            callback(body)
        })
        compressed_js_script(body, 'batteryAndClock', base)
        compressed_js_script(body, 'lineSizeRounding', base)
        if (user) {

            compressed_js_script(body, 'confirmDialog', base)
            window.signOutTimeout = response.signOutTimeout
            localNavigation.onUnload(function () {
                delete window.signOutTimeout
            })
            compressed_js_script(body, 'signOutConfirm', base)

            if (response.session_remembered !== true) {
                compressed_js_script(body, 'sessionTimeout', base)
            }

        }

        var scriptsCallback = options.scripts
        if (scriptsCallback !== undefined) scriptsCallback(body)

    }

}
