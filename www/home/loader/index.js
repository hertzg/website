(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'home/loader/')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)

            document.title = 'Home'
            loadCallback()
            ui.page(response, '../', function (body) {
                ui.Page_emptyTabs(body, function (div) {
                    ui.Page_sessionMessages(div, response.messages)
                })
                ui.Page_panel(body, 'Options', function (div) {
                    ui.Page_twoColumns(div, function (div) {
                        ui.Page_imageArrowLink(div, function (div) {
                            ui.Text(div, 'Account')
                        }, '../account/', 'account', { id: 'account' })
                    }, function (div) {
                        ui.Page_imageArrowLink(div, function (div) {
                            ui.Text(div, 'Customize Home')
                        }, 'customize/', 'edit-home', { id: 'customize' })
                    })
                    ui.Hr(div)
                    ui.Page_imageArrowLink(div, function (div) {
                        ui.Text(div, 'Help')
                    }, '../help/', 'help', {
                        id: 'help',
                        localNavigation: true,
                    })
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

    localNavigation.registerPage('home/', loadFunction)

})(localNavigation, ui)
