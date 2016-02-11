(function (localNavigation, ui, revisions) {
    localNavigation.registerPage('home/customize/', function (response, loadCallback) {

        loadCallback('Customize Home')

        var base = '../../'

        ui.page(response, base, function (body) {
            ui.Page_create(body, {
                title: 'Home',
                href: '../#customize',
                localNavigation: true,
            }, 'Customize', function (div) {
                ui.Page_sessionMessages(div, response.messages)
                ui.Page_imageArrowLinkWithDescription(div, function (div) {
                    ui.Text(div, 'Show / Hide Items')
                }, function (div) {
                    ui.Text(div, 'Change the visibility of the items.')
                }, 'show-hide/', 'show-hide', {
                    id: 'show-hide',
                    localNavigation: true,
                })
                ui.Hr(div)
                ui.Page_imageArrowLinkWithDescription(div, function (div) {
                    ui.Text(div, 'Reorder Items')
                }, function (div) {
                    ui.Text(div, 'Change the order in which the items appear.')
                }, 'reorder/', 'reorder', { id: 'reorder' })
                ui.Hr(div)
                ui.Element(div, 'div', function (div) {
                    div.id = 'restoreLink'
                    ui.Page_imageLink(div, function (div) {
                        ui.Text(div, 'Restore Defaults')
                    }, 'restore-defaults/', 'restore-defaults')
                })
            })
            ui.compressed_js_script(body, revisions, 'confirmDialog', base)
            ui.Element(body, 'script', function (script) {
                script.type = 'text/javascript'
                script.defer = true
                script.src = 'index.js'
            })
        }, {
            head: function (head) {
                ui.compressed_css_link(head, revisions, 'confirmDialog', base)
            },
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    })
})(localNavigation, ui, revisions)
