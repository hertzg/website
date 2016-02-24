(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        loadCallback('Close Account')

        ui.user_page(response, '../../', function (body) {
            ui.Page_create(body, {
                title: 'Account',
                href: '../#close',
            }, 'Close', function (div) {
                ui.Page_sessionErrors(div, response.errors)
                ui.Page_warnings(div, [
                    'Are you sure you want to close your account?',
                    'You will lose all your data.',
                ])
                ui.Element(div, 'form', function (form) {

                    form.action = 'submit.php'
                    form.method = 'post'

                    ui.Form_password(form, 'password', 'Password', {
                        value: response.values.password,
                        autofocus: true,
                        required: true,
                    })
                    ui.Hr(form)
                    ui.Form_button(form, 'Close Account')
                    ui.Page_phishingWarning(form, response.absoluteBase)

                })
            })
        })

        localNavigation.scanLinks()

    }

    localNavigation.registerPage('account/close/', loader)

})(localNavigation, ui)
