(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'help/feedback/load.php')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)
            var user = response.user

            document.title = 'Leave Feedback'
            loadCallback()
            Element(body, 'div', function (div) {
                div.id = 'tbar'
                Element(div, 'div', function (div) {
                    div.id = 'tbar-limit'
                    Element(div, 'a', function (a) {
                        a.className = 'topLink logoLink'
                        a.href = user ? '../../home/' : '../../'
                        Element(a, 'img', function (img) {
                            img.alt = 'Zvini'
                            img.className = 'logoLink-img'
                            img.src = '../../' + response.logoSrc
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
                    if (user) {
                        Element(div, 'div', function (div) {
                            div.className = 'pageTopRightLinks'
                            Element(div, 'a', function (a) {
                                a.id = 'signOutLink'
                                a.className = 'topLink'
                                a.href = '../../sign-out/'
                                Text(a, 'Sign Out')
                            })
                        })
                    }
                })
            })
            ui.Page_create(body, {
                title: 'Help',
                href: '../#leave-feedback',
            }, 'Leave Feedback', function (div) {
                Element(div, 'form', function (form) {
                    form.action = 'submit.php'
                    form.method = 'post'
                    ui.Form_textarea(form, 'text', 'Text', {
                        required: true,
                        autofocus: true,
                    })
                    ui.Hr(form)
                    ui.Form_button(form, 'Submit Feedback')
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
        Text = ui.Text

    var body = document.body
    localNavigation.registerPage('help/feedback/', loadFunction)

})(localNavigation, ui)
