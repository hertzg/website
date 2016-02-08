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
        })

    }
})(defaultThemeColor, revisions)
