var page = (function (defaultThemeColor, revisions) {
    return function (response, base, callback, options) {

        if (options === undefined) options = {}

        var user = response.user

        var themeColor
        if (user) themeColor = user.theme_color
        else themeColor = defaultThemeColor

        window.base = base
        window.time = response.time
        window.timezone = response.timezone

        if (user) {
            compressed_css_link(document.head, revisions, 'confirmDialog', base)
        }

        var body = document.body
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
        compressed_js_script(body, revisions, 'batteryAndClock', base)
        compressed_js_script(body, revisions, 'lineSizeRounding', base)
        if (user) {

            compressed_js_script(body, revisions, 'confirmDialog', base)
            window.signOutTimeout = response.signOutTimeout
            compressed_js_script(body, revisions, 'signOutConfirm', base)

            if (response.session_remembered !== true) {
                compressed_js_script(body, revisions, 'sessionTimeout', base)
            }

        }

        var scriptsCallback = options.scripts
        if (scriptsCallback !== undefined) scriptsCallback(body)

    }
})(defaultThemeColor, revisions)
