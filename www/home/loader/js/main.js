(function (localNavigation, ui) {
    localNavigation.registerPage('home/', function (response, loadCallback) {

        loadCallback('Home')

        ui.page(response, '../', function (body) {
            ui.Page_emptyTabs(body, function (div) {
                ui.Page_sessionMessages(div, response.messages)
                ui.Page_sessionWarnings(div, response.warnings)
                ui.SearchForm_create(div, '../search/', function (div) {
                    ui.SearchForm_emptyContent(div, 'Search...')
                })
                ui.Hr(div)
                ui.Page_thumbnails(div, HomeItems(response))
            })
            ui.Page_panel(body, 'Options', function (div) {
                ui.Page_twoColumns(div, function (div) {
                    ui.Page_imageArrowLink(div, function (div) {
                        ui.Text(div, 'Account')
                    }, '../account/', 'account', { id: 'account' })
                }, function (div) {
                    ui.Page_imageArrowLink(div, function (div) {
                        ui.Text(div, 'Customize Home')
                    }, 'customize/', 'edit-home', {
                        id: 'customize',
                        localNavigation: true,
                    })
                })
                ui.Hr(div)
                ui.Page_imageArrowLink(div, function (div) {
                    ui.Text(div, 'Help')
                }, '../help/', 'help', {
                    id: 'help',
                    localNavigation: true,
                })
            })
        }, {
            head: function (head) {
                ui.compressed_css_link(head, 'calendarIcon', '../')
            },
            scripts: function (body) {
                ui.compressed_js_script(body, 'searchForm', '../')
            },
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    })
})(localNavigation, ui)