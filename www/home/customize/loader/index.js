(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        loadCallback('Customize Home')

        var base = '../../'

        ui.user_page(response, base, function (body) {
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
                }, 'reorder/', 'reorder', {
                    id: 'reorder',
                    localNavigation: true,
                })
                ui.Hr(div)
                ui.Page_imageLink(div, function (div) {
                    ui.Text(div, 'Restore Defaults')
                }, 'restore-defaults/', 'restore-defaults', {
                    id: 'restore-defaults',
                })
            })
        }, {
            head: function (head) {
                ui.compressed_css_link(head, 'confirmDialog', base)
            },
            scripts: [
                ui.compressed_js_script('confirmDialog', base),
                'index.js',
            ],
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    }

    localNavigation.registerPage('home/customize/', loader)

})(localNavigation, ui)
