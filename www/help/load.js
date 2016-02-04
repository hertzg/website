(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback, unload) {

        function error () {
            errorCallback(newBase)
        }

        var request = new XMLHttpRequest
        request.open('get', base + 'home/load.php')
        request.send()
        request.onerror = error
        request.onload = function () {

            if (request.status !== 200) {
                error()
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
            Page_create(body, {
                title: 'Home',
                href: '../home/#help',
            }, 'Help', function (div) {
                Page_imageLink(div, 'Install Zvini App', 'install-zvini-app/',
                    'download', { id: 'install-zvini-app' })
                Hr(div)
                Page_imageLink(div, 'Install Link Handlers',
                    'install-link-handlers/', 'protocol',
                    { id: 'install-link-handlers' })
                Hr(div)
                Page_imageArrowLink(div, 'Leave Feedback',
                    'feedback/', 'feedback', { id: 'feedback' })
                Hr(div)
                Page_imageArrowLink(div, 'API Documentation',
                    'api-doc/', 'api-doc', { id: 'api-doc' })
                Hr(div)
                Page_imageArrowLink(div, 'About Zvini',
                    'about-zvini/', 'zvini', { id: 'about-zvini' })
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
        Page_create = ui.Page_create,
        Page_imageArrowLink = ui.Page_imageArrowLink,
        Page_imageLink = ui.Page_imageLink,
        Text = ui.Text

    var newBase = '../'
    var body = document.body
    localNavigation.registerPage('help/', loadFunction)

})(localNavigation, ui)
