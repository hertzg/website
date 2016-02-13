(function (localNavigation, ui) {
    localNavigation.registerPage('help/', function (response, loadCallback) {

        loadCallback('Help')

        ui.public_page(response, '../', function (body) {
            ui.Page_create(body, {
                title: 'Home',
                href: '../home/#help',
            }, 'Help', function (div) {
                ui.Page_imageLink(div, function (div) {
                    ui.Text(div, 'Install Zvini App')
                }, 'install-zvini-app/', 'download', {
                    id: 'install-zvini-app',
                })
                ui.Hr(div)
                ui.Page_imageLink(div, function (div) {
                    ui.Text(div, 'Install Link Handlers')
                }, 'install-link-handlers/', 'protocol', {
                    id: 'install-link-handlers',
                    localNavigation: true,
                })
                ui.Hr(div)
                ui.Page_imageArrowLink(div, function (div) {
                    ui.Text(div, 'Leave Feedback')
                }, 'feedback/', 'feedback', {
                    id: 'feedback',
                    localNavigation: true,
                })
                ui.Hr(div)
                ui.Page_imageArrowLink(div, function (div) {
                    ui.Text(div, 'API Documentation')
                }, 'api-doc/', 'api-doc', { id: 'api-doc' })
                ui.Hr(div)
                ui.Page_imageArrowLink(div, function (div) {
                    ui.Text(div, 'About Zvini')
                }, 'about-zvini/', 'zvini', {
                    id: 'about-zvini',
                    localNavigation: true,
                })
            })
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    })
})(localNavigation, ui)
