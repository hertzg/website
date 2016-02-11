(function (localNavigation, ui) {
    localNavigation.registerPage('home/customize/show-hide/', function (response, loadCallback) {

        loadCallback('Show / Hide Items')

        var base = '../../../'

        ui.page(response, base, function (body) {
            ui.Page_create(body, {
                title: 'Customize Home',
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

                    var first = true
                    for (var key in items) {

                        if (key === 'admin' && user.admin === true) continue

                        if (first) first = false
                        else ui.Hr(div)

                        var item = items[key],
                            propertyPart = item[1],
                            userProperty = 'show_' + propertyPart

                        ui.Form_checkboxItem(div, propertyPart,
                            item[0], user[userProperty] === true)

                    }

                    ui.Hr(div)
                    ui.Form_button(div, 'Save Changes')

                })
            })
            ui.Page_panel(body, 'Options', function (div) {
                ui.Page_imageArrowLinkWithDescription(div, function (div) {
                    ui.Text(div, 'Reorder Items')
                }, function (div) {
                    ui.Text(div, 'Change the order in which the items appear.')
                }, '../reorder/', 'reorder')
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

    })
})(localNavigation, ui)
