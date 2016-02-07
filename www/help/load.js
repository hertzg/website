(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'help/load.php')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)
            var user = response.user

            document.title = 'Help'
            loadCallback()
            ui.public_page(body, user, '../')
            ui.Page_create(body, {
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
                Page_imageArrowLink(div, 'Leave Feedback', 'feedback/', 'feedback', {
                    id: 'feedback',
                    localNavigation: true,
                })
                Hr(div)
                Page_imageArrowLink(div, 'API Documentation',
                    'api-doc/', 'api-doc', { id: 'api-doc' })
                Hr(div)
                Page_imageArrowLink(div, 'About Zvini',
                    'about-zvini/', 'zvini', { id: 'about-zvini' })
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
        Hr = ui.Hr,
        Page_imageArrowLink = ui.Page_imageArrowLink,
        Page_imageLink = ui.Page_imageLink,
        Text = ui.Text

    var body = document.body
    localNavigation.registerPage('help/', loadFunction)

})(localNavigation, ui)
