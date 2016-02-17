(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        loadCallback('Show / Hide Items')

        var base = '../../../'

        ui.user_page(response, base, function (body) {
            ui.Page_create(body, {
                title: 'Customize',
                href: '../#show-hide',
                localNavigation: true,
            }, 'Show / Hide Items', function (div) {
                ui.Page_sessionMessages(div, response.messages)
                ui.Page_text(div, function (div) {
                    ui.Text(div, 'Select the items you want to see on your home page:')
                })
                ui.Element(div, 'form', function (form) {

                    form.action = 'submit.php'
                    form.method = 'post'

                    var user = response.user,
                        items = response.homeItems

                    for (var key in items) {

                        var item = items[key],
                            propertyPart = item[1],
                            userProperty = 'show_' + propertyPart

                        ui.Form_checkboxItem(form, propertyPart,
                            item[0], user[userProperty] === true)
                        ui.Hr(form)

                    }

                    ui.Form_button(form, 'Save Changes')

                })
            })
            ui.Page_panel(body, 'Options', function (div) {
                ui.Page_imageArrowLinkWithDescription(div, function (div) {
                    ui.Text(div, 'Reorder Items')
                }, function (div) {
                    ui.Text(div, 'Change the order in which the items appear.')
                }, '../reorder/', 'reorder', { localNavigation: true })
                ui.Hr(div)
                ui.Element(div, 'div', function (div) {
                    div.id = 'restoreLink'
                    ui.Page_imageLink(div, function (div) {
                        ui.Text(div, 'Restore Defaults')
                    }, 'restore-defaults/', 'restore-defaults')
                })
            })
        }, {
            head: function (head) {
                ui.compressed_css_link(head, 'confirmDialog', base)
            },
            scripts: function (body) {
                ui.compressed_js_script(body, 'formCheckbox', base)
                ui.compressed_js_script(body, 'confirmDialog', base)
                ui.Element(body, 'script', function (script) {
                    script.type = 'text/javascript'
                    script.src = 'index.js'
                })
            },
        })

        localNavigation.scanLinks()

    }

    localNavigation.registerPage('home/customize/show-hide/', loader)

})(localNavigation, ui)
