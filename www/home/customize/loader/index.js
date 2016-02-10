(function (localNavigation, ui, revisions) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'home/customize/loader/')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)

            document.title = 'Customize Home'
            loadCallback()

            var newBase = '../../'

            ui.compressed_css_link(document.head, revisions, 'confirmDialog', newBase)

            ui.page(response, newBase, function (body) {
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
                    }, 'show-hide/', 'show-hide', { id: 'show-hide' })
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
                ui.compressed_js_script(body, revisions, 'confirmDialog', newBase)
                ui.Element(body, 'script', function (script) {
                    script.type = 'text/javascript'
                    script.defer = true
                    script.src = 'index.js'
                })
            })

            localNavigation.scanLinks()
            localNavigation.focusTarget()

        }

        return {
            abort: function () {
                request.abort()
            },
        }

    }

    localNavigation.registerPage('home/customize/', loadFunction)

})(localNavigation, ui, revisions)
