(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'home/load.php')
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
            Element(body, 'div', function (div) {
                div.id = 'tbar'
                Element(div, 'div', function (div) {
                    div.id = 'tbar-limit'
                    Element(div, 'a', function (a) {
                        a.className = 'topLink logoLink'
                        a.href = '../'
                        Element(a, 'img', function (img) {
                            img.alt = 'Zvini'
                            img.className = 'logoLink-img'
                            img.src = '../' + response.logoSrc
                        })
                    })
                    Element(div, 'div', function (div) {
                        div.className = 'page-clockWrapper'
                        Element(div, 'div', function (div) {
                            div.id = 'batteryWrapper'
                        })
                        Element(div, 'div', function (div) {
                            div.id = 'dynamicClockWrapper'
                            Text(div, '00:00:00')
                        })
                    })
                    Element(div, 'div', function (div) {
                        div.className = 'pageTopRightLinks'
                        Element(div, 'a', function (a) {
                            a.id = 'signOutLink'
                            a.className = 'topLink'
                            a.href = '../sign-out/'
                            Text(a, 'Sign Out')
                        })
                    })
                })
            })
            ui.Page_emptyTabs(body, function (div) {
            })
            ui.Page_panel(body, 'Options', function (div) {
                ui.Page_twoColumns(div, function (div) {
                    Page_imageArrowLink(div, 'Account',
                        '../account/', 'account', { id: 'account' })
                }, function (div) {
                    Page_imageArrowLink(div, 'Customize Home',
                        'customize/', 'edit-home', { id: 'customize' })
                })
                ui.Hr(div)
                Page_imageArrowLink(div, 'Help', '../help/', 'help', {
                    id: 'help',
                    localNavigation: true,
                })
            })
            localNavigation.scanLinks()

        }

        return {
            abort: function () {
                request.abort()
            },
        }

    }

    var Element = ui.Element,
        Page_imageArrowLink = ui.Page_imageArrowLink,
        Text = ui.Text

    var body = document.body
    localNavigation.registerPage('home/', loadFunction)

})(localNavigation, ui)
