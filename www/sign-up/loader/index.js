(function (localNavigation, ui) {
    localNavigation.registerPage('sign-up/', function (response, loadCallback) {

        loadCallback('Create an Account')

        var values = response.values
        var focus = values.focus
        var returnVar = values['return']

        var queryString
        if (returnVar === '') queryString = ''
        else queryString = '?return=' + encodeURIComponent(returnVar)

        var base = '../'

        ui.guest_page(response, base, function (body) {
            ui.Page_title(body, 'Create an Account', function (div) {

                if (response.signUpEnabled === true) {
                    ui.Page_sessionErrors(div, response.errors)
                } else {
                    ui.Page_errors(div, [
                        'This form has been disabled.' +
                        ' You no longer can create an account.',
                    ])
                }

                ui.Element(div, 'form', function (form) {

                    form.action = 'submit.php'
                    form.method = 'post'

                    ui.Form_textfield(form, 'username', 'Username', {
                        maxlength: response.usernameMaxLength,
                        value: values.username,
                        autofocus: focus === 'username',
                        required: true,
                    })
                    ui.Form_notes(form, [
                        'Case-sensitive.',
                        'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
                        'Minimum ' + response.usernameMinLength + ' characters.',
                    ])
                    ui.Hr(form)
                    ui.Form_password(form, 'password', 'Password', {
                        value: values.password,
                        autofocus: focus === 'password',
                        required: true,
                    })
                    ui.Form_notes(form, [
                        'Minimum ' + response.passwordMinLength + ' characters.',
                        'Example: ' + response.examplePassword,
                    ])
                    ui.Hr(form)
                    ui.Form_password(form, 'repeatPassword', 'Repeat password', {
                        value: values.password,
                        autofocus: focus === 'repeatPassword',
                        required: true,
                    })
                    ui.Hr(form)
                    ui.Form_textfield(form, 'email', 'Email', {
                        value: values.email,
                        maxlength: response.emailMaxLength,
                        autofocus: focus === 'email',
                    })
                    ui.Form_notes(form, [
                        'Optional. Used for password recovery.',
                    ])
                    ui.Hr(form)
                    ui.Form_captcha(form, response, base, focus === 'captcha')
                    ui.Form_button(form, 'Sign Up')
                    ui.Form_hidden(form, 'return', returnVar)

                })

            })
            ui.Page_panel(body, 'Options', function (div) {
                ui.Page_imageLinkWithDescription(div, function (div) {
                    ui.Text(div, 'Already have an account?')
                }, function (div) {
                    ui.Text(div, 'Sign in here.')
                }, '../sign-in/' + queryString, 'sign-in', {
                    localNavigation: true,
                })
            })
        })

        localNavigation.scanLinks()

    })
})(localNavigation, ui)
