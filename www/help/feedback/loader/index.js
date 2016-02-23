(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        loadCallback('Leave Feedback')

        var base = '../../'

        ui.public_page(response, base, function (body) {
            ui.Page_create(body, {
                title: 'Help',
                href: '../#feedback',
            }, 'Leave Feedback', function (div) {
                ui.Page_sessionErrors(div, response.errors, {
                    ENTER_TEXT: 'Enter text.',
                })
                ui.Element(div, 'form', function (form) {

                    form.action = 'submit.php'
                    form.method = 'post'

                    ui.Form_textarea(form, 'text', 'Text', {
                        maxlength: response.maxLengths.text,
                        autofocus: true,
                        required: true,
                    })
                    ui.Hr(form)
                    ui.Form_button(form, 'Submit Feedback')

                })
            })
        }, {
            scripts: [ui.compressed_js_script('flexTextarea', base)],
        })

        localNavigation.scanLinks()

    }

    localNavigation.registerPage('help/feedback/', loader)

})(localNavigation, ui)
