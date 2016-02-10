(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'email-reset-password/loader/')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)
            var values = response.values
            var focus = values.focus
            var returnVar = values['return']

            var queryString
            if (returnVar === '') queryString = ''
            else queryString = '?return=' + encodeURIComponent(returnVar)

            document.title = 'Reset Password'
            loadCallback()

            var newBase = '../'

            ui.guest_page(response, newBase, function (body) {
                ui.Page_create(body, {
                    title: 'Sign In',
                    href: '../sign-in/' + queryString + '#email-reset-password',
                    localNavigation: true,
                }, 'Reset Password', function (div) {
                    ui.Page_sessionErrors(div, response.errors)
                    ui.Element(div, 'form', function (form) {

                        form.action = 'submit.php'
                        form.method = 'post'

                        ui.Form_textfield(form, 'email', 'Email', {
                            value: values.email,
                            maxlength: response.emailMaxLength,
                            autofocus: focus === 'email',
                        })
                        ui.Hr(form)
                        ui.Form_captcha(form, response, newBase, focus === 'captcha')
                        ui.Form_button(form, 'Send Recovery Email')
                        ui.Form_hidden(form, 'return', returnVar)

                    })
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

    localNavigation.registerPage('email-reset-password/', loadFunction)

})(localNavigation, ui)
