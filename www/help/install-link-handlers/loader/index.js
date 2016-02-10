(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'help/install-link-handlers/loader/')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)

            document.title = 'Install Link Handlers'
            loadCallback()

            window.siteTitle = response.siteTitle
            localNavigation.onUnload(function () {
                delete window.siteTitle
            })

            ui.public_page(response, '../../', function (body) {
                ui.Page_create(body, {
                    title: 'Help',
                    href: '../#install-link-handlers',
                }, 'Install Link Handlers', function (div) {
                    ui.Element(div, 'noscript', function (noscript) {
                        ui.Text(noscript, "We're sorry." +
                            ' The link handlers cannot be installed without' +
                            ' enabling JavaScript in your web browser.')
                    })
                    ui.Element(div, 'div', function (div) {
                        div.id = 'jsContent'
                        div.style.display = 'none'
                        ui.Page_imageLink(div, function (div) {
                            ui.Text(div, 'mailto: Link')
                        }, '', 'protocol', { id: 'mailto' })
                        ui.Hr(div)
                        ui.Page_imageLink(div, function (div) {
                            ui.Text(div, 'sms: Link')
                        }, '', 'protocol', { id: 'sms' })
                        ui.Hr(div)
                        ui.Page_imageArrowLink(div, function (div) {
                            ui.Text(div, 'tel: Link')
                        }, '', 'protocol', { id: 'tel' })
                    })
                    ui.Element(div, 'script', function (script) {
                        script.type = 'text/javascript'
                        script.async = true
                        script.src = 'index.js?3'
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

    localNavigation.registerPage('help/install-link-handlers/', loadFunction)

})(localNavigation, ui)
