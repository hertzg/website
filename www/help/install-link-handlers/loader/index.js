(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        loadCallback('Install Link Handlers')

        window.siteTitle = response.siteTitle
        localNavigation.onUnload(function () {
            delete window.siteTitle
        })

        ui.public_page(response, '../../', function (body) {
            ui.Page_create(body, {
                title: 'Help',
                href: '../#install-link-handlers',
            }, 'Install Link Handlers', function (div) {
                ui.Page_text(div, function (div) {
                    ui.Text(div, 'Link handlers register this Zvini instance' +
                        ' in your web browser as an alternative way' +
                        ' of opening certain types of links that you' +
                        ' encounter on the web. Note that this feature' +
                        ' is not available in some browsers.')
                })
                ui.Element(div, 'noscript', function (noscript) {
                    ui.Text(noscript, "We're sorry." +
                        ' The link handlers cannot be installed without' +
                        ' enabling JavaScript in your web browser.')
                })
                ui.Element(div, 'div', function (div) {
                    div.id = 'jsContent'
                    div.style.display = 'none'
                    ui.Page_imageLink(div, function (div) {
                        ui.Text(div, 'Install Email Link Handler')
                    }, '', 'protocol', { id: 'mailto' })
                    ui.Hr(div)
                    ui.Page_imageLink(div, function (div) {
                        ui.Text(div, 'Install SMS Link Handler')
                    }, '', 'protocol', { id: 'sms' })
                    ui.Hr(div)
                    ui.Page_imageLink(div, function (div) {
                        ui.Text(div, 'Install Telephone Link Handler')
                    }, '', 'protocol', { id: 'tel' })
                })
                ui.Element(div, 'script', function (script) {
                    script.type = 'text/javascript'
                    script.src = 'index.js?3'
                })
            })
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    }

    localNavigation.registerPage('help/install-link-handlers/', loader)

})(localNavigation, ui)
