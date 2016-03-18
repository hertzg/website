(function (localNavigation, ui) {
    localNavigation.registerPage('sign-in/', function (response, loadCallback) {

        loadCallback('Sign In')

        var values = response.values
        var username = values.username
        var returnVar = values['return']

        var queryString
        if (returnVar === '') queryString = ''
        else queryString = '?return=' + encodeURIComponent(returnVar)

        var base = '../'

        ui.guest_page(response, base, function (body) {
            ui.Page_title(body, 'Sign In', function (div) {
                ui.Page_sessionMessages(div, response.messages)
                ui.Page_sessionErrors(div, response.errors, {
                    ENTER_PASSWORD: 'Enter password.',
                    ENTER_USERNAME: 'Enter username.',
                    INVALID_USERNAME: 'The username is invalid.',
                    USER_DISABLED: 'Your account is disabled.',
                    INVALID_USERNAME_OR_PASSWORD:
                        'Invalid username or password.',
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
                    ui.Page_phishingWarning(form, response.absoluteBase)

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
            scripts: [ui.compressed_js_script('formCheckbox', base)],
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    })
})(localNavigation, ui)
