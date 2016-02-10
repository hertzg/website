(function (localNavigation, ui) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'help/about-zvini/loader/')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)
            var gitCommit = response.gitCommit

            document.title = 'About Zvini'
            loadCallback()

            ui.public_page(response, '../../', function (body) {
                ui.Page_create(body, {
                    title: 'Help',
                    href: '../#about-zvini',
                }, 'About Zvini', function (div) {
                    ui.Page_text(div, function (div) {
                        ui.Text(div, 'This program is free software: you' +
                            ' can redistribute it and/or modify it under the' +
                            ' terms of the GNU Affero General Public License' +
                            ' as published by the Free Software Foundation,' +
                            ' either version 3 of the License, or (at your' +
                            ' option) any later version.')
                        ui.Element(div, 'br', function () {})
                        ui.Element(div, 'br', function () {})
                        ui.Text(div, 'This program is distributed in the' +
                            ' hope that it will be useful, but WITHOUT ANY' +
                            ' WARRANTY; without even the implied warranty of' +
                            ' MERCHANTABILITY or FITNESS FOR A PARTICULAR' +
                            ' PURPOSE. See the GNU Affero General Public' +
                            ' License for more details.')
                    })
                    ui.Hr(div)
                    ui.Page_imageArrowLink(div, function (div) {
                        ui.Text(div, 'GNU Affero General Public License')
                    }, 'license/', 'license', { id: 'license' })
                })
                ui.Page_panel(body, 'Git Commit', function (div) {
                    ui.Form_label(div, 'Hash', function (div) {
                        ui.Text(div, gitCommit.hash)
                    })
                    ui.Hr(div)
                    ui.Form_label(div, 'Tag', function (div) {
                        ui.Text(div, gitCommit.tag)
                    })
                    ui.Hr(div)
                    ui.Form_label(div, 'Date', function (div) {
                        ui.export_date_ago(div, response.time, gitCommit.date, true)
                    })
                })
            }, {
                scripts: function (body) {
                    ui.compressed_js_script(body, revisions, 'dateAgo', '../../')
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

    localNavigation.registerPage('help/about-zvini/', loadFunction)

})(localNavigation, ui)
