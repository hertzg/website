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

        if (user) compressed_css_link(head, 'confirmDialog', base)

        Element(body, 'div', function (div) {
            div.id = 'tbar'
            Element(div, 'div', function (div) {
                div.id = 'tbar-limit'
                Element(div, 'a', function (a) {

                    var href = options.logoHref
                    if (href === undefined) href = base === '' ? './' : base

                    a.href = href
                    a.className = 'topLink logoLink localNavigation-link'

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

        var scripts = [
            compressed_js_script('batteryAndClock', base),
            compressed_js_script('lineSizeRounding', base),
        ]
        if (user) {

            window.signOutTimeout = response.signOutTimeout
            localNavigation.onUnload(function () {
                delete window.signOutTimeout
            })

            scripts.push(compressed_js_script('confirmDialog', base))
            scripts.push(compressed_js_script('signOutConfirm', base))

            if (response.session_remembered !== true) {
                scripts.push(compressed_js_script('sessionTimeout', base))
            }

        }

        var additionalScripts = options.scripts
        if (additionalScripts !== undefined) {
            scripts.push.apply(scripts, additionalScripts)
        }

        var loadScripts = LoadScripts(scripts, function () {
            localNavigation.unUnload(loadScripts.abort)
        })
        localNavigation.onUnload(loadScripts.abort)

    }

}
