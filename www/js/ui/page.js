function page (body, user, base, options) {
    if (options === undefined) options = {}
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
                    img.alt = 'Zvini'
                    img.className = 'logoLink-img'
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
