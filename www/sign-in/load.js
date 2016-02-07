(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'sign-in/load.php')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)

            document.title = 'Sign In'
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
/*
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
*/
                })
            })
            ui.Page_title(body, 'Sign In', function (div) {
                Element(div, 'form', function (form) {
                    ui.Form_textfield(form, 'username', 'Username', {
                        required: true,
                    })
                    Hr(form)
                    ui.Form_password(form, 'password', 'Password', {
                        required: true,
                    })
                    Hr(form)
                    ui.Form_button(form, 'Sign In')
                })
            })
            ui.Page_panel(body, 'Options', function (div) {
                ui.Page_imageArrowLinkWithDescription(div,
                    'Forgot password?', 'Reset your account password here.',
                    '../email-reset-password/', 'reset-password',
                    { id: 'email-reset-password' })
                if (response.sign_up_enabled) {
                    Hr(div)
                    ui.Page_imageArrowLinkWithDescription(div,
                        "Don't have an account?", 'Create an account here.',
                        '../sign-up/', 'new-password', {})
                }
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
        Hr = ui.Hr

    var body = document.body
    localNavigation.registerPage('sign-in/', loadFunction)

})(localNavigation, ui)
