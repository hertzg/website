function guest_page (body, base) {
    Element(body, 'div', function (div) {
        div.id = 'tbar'
        Element(div, 'div', function (div) {
            div.id = 'tbar-limit'
            Element(div, 'a', function (a) {
                a.className = 'topLink logoLink'
                a.href = base
                Element(a, 'img', function (img) {
                    img.alt = 'Zvini'
                    img.className = 'logoLink-img'
                })
            })
        })
    })
}
