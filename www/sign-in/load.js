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
            var values = response.values

            document.title = 'Sign In'
            loadCallback()
            ui.guest_page(body, '../')
            ui.Page_title(body, 'Sign In', function (div) {
                Element(div, 'form', function (form) {
                    form.action = 'submit.php'
                    form.method = 'post'
                    ui.Form_textfield(form, 'username', 'Username', {
                        value: values.username,
                        required: true,
                        autofocus: true,
                    })
                    Hr(form)
                    ui.Form_password(form, 'password', 'Password', {
                        value: values.password,
                        required: true,
                    })
                    Hr(form)
                    ui.Form_checkbox(form, 'remember',
                        'Stay signed in', values.remember)
                    Hr(form)
                    ui.Form_button(form, 'Sign In')
                    ui.Form_hidden(form, 'return', values['return'])
                    ui.Page_phishingWarning(form, base)
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
