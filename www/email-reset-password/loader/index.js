(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        loadCallback('Reset Password')

        var values = response.values
        var focus = values.focus
        var returnVar = values['return']

        var queryString
        if (returnVar === '') queryString = ''
        else queryString = '?return=' + encodeURIComponent(returnVar)

        var base = '../'

        ui.guest_page(response, base, function (body) {
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
                    ui.Form_captcha(form, response, base, focus === 'captcha')
                    ui.Form_button(form, 'Send Recovery Email')
                    ui.Form_hidden(form, 'return', returnVar)

                })
            })
        })

        localNavigation.scanLinks()

    }

    localNavigation.registerPage('email-reset-password/', loader)

})(localNavigation, ui)
