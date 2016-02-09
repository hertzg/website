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

            document.title = 'Leave Feedback'
            loadCallback()
            ui.public_page(body, response, '../../')
            ui.Page_create(body, {
                title: 'Help',
                href: '../#leave-feedback',
            }, 'Leave Feedback', function (div) {
                ui.Page_sessionErrors(div, response.errors, {
                    ENTER_TEXT: 'Enter text.',
                })
                Element(div, 'form', function (form) {
                    form.action = 'submit.php'
                    form.method = 'post'
                    ui.Form_textarea(form, 'text', 'Text', {
                        maxlength: response.maxLengths.text,
                        required: true,
                        autofocus: true,
                    })
                    ui.Hr(form)
                    ui.Form_button(form, 'Submit Feedback')
                })
            })
            ui.compressed_js_script(body, revisions, 'flexTextarea', '../../')

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
