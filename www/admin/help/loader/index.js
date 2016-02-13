(function (localNavigation, ui) {
    localNavigation.registerPage('admin/help/', function (response, loadCallback) {

        loadCallback('Help')

        ui.admin_page(response, '../', function (body) {
            ui.Page_create(body, {
                title: 'Administration',
                href: '../#help',
            }, 'Help', function (div) {
                ui.Page_imageArrowLink(div, function (div) {
                    ui.Text(div, 'Admin API Documentation')
                }, 'admin-api-doc/', 'api-doc', { id: 'admin-api-doc' })
                ui.Hr(div)
                ui.Page_imageArrowLink(div, function (div) {
                    ui.Text(div, 'Exchange API Documentation')
                }, 'exchange-api-doc', 'api-doc', { id: 'exchange-api-doc' })
            })
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    })
})(localNavigation, ui)
