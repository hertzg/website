(function (localNavigation, ui, revisions) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'sign-in/loader/')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)
            var values = response.values
            var username = values.username
            var returnVar = values['return']

            var queryString
            if (returnVar === '') queryString = ''
            else queryString = '?return=' + encodeURIComponent(returnVar)

            document.title = 'Sign In'
            loadCallback()

            var newBase = '../'

            ui.guest_page(response, newBase, function (body) {
                ui.Page_title(body, 'Sign In', function (div) {
                    ui.Page_sessionMessages(div, response.messages)
                    ui.Page_sessionErrors(div, response.errors, {
                        ENTER_PASSWORD: 'Enter password.',
                        ENTER_USERNAME: 'Enter username.',
                        INVALID_USERNAME: 'The username is invalid.',
                        USER_DISABLED: 'Your account is disabled.',
                        INVALID_USERNAME_OR_PASSWORD: 'Invalid username or password.',
                    })
                    if (values['return'] !== '') {
                        ui.Page_warnings(div, [
                            'You need to be signed in to access the page.',
                        ])
                    }
                    ui.Element(div, 'form', function (form) {

                        form.action = 'submit.php'
                        form.method = 'post'

                        ui.Form_textfield(form, 'username', 'Username', {
                            maxlength: response.usernameMaxLength,
                            value: username,
                            autofocus: username === '',
                            required: true,
                        })
                        ui.Hr(form)
                        ui.Form_password(form, 'password', 'Password', {
                            value: values.password,
                            autofocus: username !== '',
                            required: true,
                        })
                        ui.Hr(form)
                        ui.Form_checkbox(form, 'remember',
                            'Stay signed in', values.remember)
                        ui.Hr(form)
                        ui.Form_button(form, 'Sign In')
                        ui.Form_hidden(form, 'return', returnVar)
                        ui.Page_phishingWarning(form, base)

                    })
                })
                ui.Page_panel(body, 'Options', function (div) {
                    ui.Page_imageArrowLinkWithDescription(div, function (div) {
                        ui.Text(div, 'Forgot password?')
                    }, function (div) {
                        ui.Text(div, 'Reset your account password here.')
                    }, '../email-reset-password/' + queryString, 'reset-password', {
                        id: 'email-reset-password',
                        localNavigation: true,
                    })
                    if (response.signUpEnabled === true) {
                        ui.Hr(div)
                        ui.Page_imageLinkWithDescription(div, function (div) {
                            ui.Text(div, "Don't have an account?")
                        }, function (div) {
                            ui.Text(div, 'Create an account here.')
                        }, '../sign-up/' + queryString, 'new-password', {
                            localNavigation: true,
                        })
                    }
                })
            }, {
                scripts: function (body) {
                    ui.compressed_js_script(body, revisions, 'formCheckbox', newBase)
                },
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

    localNavigation.registerPage('sign-in/', loadFunction)

})(localNavigation, ui, revisions)
