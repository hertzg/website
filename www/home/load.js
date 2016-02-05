(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback, unload) {

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

            unload()
            document.title = 'Home'
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
                            img.src = base + response.logoSrc
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
            Page_emptyTabs(body, function (div) {
            })
            Page_panel(body, 'Options', function (div) {
                Page_twoColumns(div, function (div) {
                    Page_imageArrowLink(div, 'Account',
                        '../account/', 'account', { id: 'account' })
                }, function (div) {
                    Page_imageArrowLink(div, 'Customize Home',
                        'customize/', 'edit-home', { id: 'customize' })
                })
                Hr(div)
                Page_imageArrowLink(div, 'Help', '../help/', 'help', {
                    id: 'help',
                    localNavigation: true,
                })
            })
            loadCallback(newBase)

        }

        return {
            abort: function () {
                request.abort()
            },
        }

    }

    var Element = ui.Element,
        Hr = ui.Hr,
        Page_emptyTabs = ui.Page_emptyTabs,
        Page_imageArrowLink = ui.Page_imageArrowLink,
        Page_imageLink = ui.Page_imageLink,
        Page_panel = ui.Page_panel,
        Page_twoColumns = ui.Page_twoColumns,
        Text = ui.Text

    var newBase = '../'
    var body = document.body
    localNavigation.registerPage('home/', loadFunction)

})(localNavigation, ui)
