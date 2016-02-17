(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        loadCallback('Reorder Items')

        ui.user_page(response, '../../../', function (body) {
            ui.Page_create(body, {
                title: 'Customize',
                href: '../#reorder',
                localNavigation: true,
            }, 'Reorder Items', function (div) {

                ui.Page_sessionMessages(div, response.messages)
                ui.Page_text(div, function (div) {
                    ui.Text(div, 'Select an item to move up or down:')
                })

                var first = true
                var items = response.homeItems
                for (var key in items) {

                    if (first) first = false
                    else ui.Hr(div)

                    var item = items[key]
                    var href = 'move/?key=' + key
                    if (key === 'calendar') {
                        ui.Element(div, 'a', function (a) {
                            a.href = href
                            a.className = 'clickable link image_link withArrow'
                            ui.Element(a, 'span', function (span) {
                                span.className = 'image_link-icon'
                                create_calendar_icon_today(span, response)
                            })
                            ui.Element(a, 'span', function (span) {
                                span.className = 'image_link-content'
                                ui.Text(span, 'Calendar')
                            })
                        })
                    } else {
                        ui.Page_imageArrowLink(div, function (div) {
                            ui.Text(div, item[0])
                        }, href, item[1], { id: key })
                    }

                }

            })
            ui.Page_panel(body, 'Options', function (div) {
                ui.Page_imageLinkWithDescription(div, function (div) {
                    ui.Text(div, 'Show / Hide Items')
                }, function (div) {
                    ui.Text(div, 'Change the visibility of the items.')
                }, '../show-hide/', 'show-hide', { localNavigation: true })
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
                ui.compressed_css_link(head, 'calendarIcon', base)
                ui.compressed_css_link(head, 'confirmDialog', base)
            },
            scripts: function (body) {
                ui.compressed_js_script(body, 'confirmDialog', base)
                ui.Element(body, 'script', function (script) {
                    script.type = 'text/javascript'
                    script.src = 'index.js'
                })
            },
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    }

    localNavigation.registerPage('home/customize/reorder/', loader)

})(localNavigation, ui)