(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'help/loader/')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)

            document.title = 'Help'
            loadCallback()

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

        }

        return {
            abort: function () {
                request.abort()
            },
        }

    }

    localNavigation.registerPage('help/', loadFunction)

})(localNavigation, ui)
