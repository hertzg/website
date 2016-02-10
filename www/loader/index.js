(function (localNavigation, ui, revisions) {

    function loadFunction (base, loadCallback, errorCallback) {

        var request = new XMLHttpRequest
        request.open('get', base + 'loader/')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)

            document.title = response.siteTitle
            loadCallback()

            window.base = ''
            localNavigation.onUnload(function () {
                delete window.base
            })

            ui.compressed_css_link(document.head, revisions, 'index', '')
            ui.Element(body, 'div', function (div) {
                div.className = 'backgroundGradient'
                ui.Element(div, 'div', function (div) {
                    div.className = 'backgroundGradient-gradient'
                })
            })
            ui.Element(body, 'div', function (div) {
                div.className = 'centerWrapper'
                ui.Element(div, 'img', function (img) {
                    var url = 'theme/color/' + response.themeColor + '/images/zvini.svg'
                    img.className = 'logoImage'
                    img.src = base + url + '?' + revisions[url]
                })
                ui.Element(div, 'div', function (div) {
                    div.className = 'siteInfo'
                    ui.Element(div, 'h1', function (h1) {
                        ui.Text(h1, 'Save Your Data in Zvini')
                    })
                    ui.Element(div, 'div', function (div) {
                        div.className = 'siteInfo-description'
                        ui.Element(div, 'div', function (div) {
                            ui.Text(div, 'Save your files, contacts, notes and more.')
                        })
                        ui.Element(div, 'div', function (div) {
                            ui.Text(div, 'It\'s free and easy.')
                        })
                    })
                })
            })
            ui.ZeroHeightBr(body)
            ui.Element(body, 'div', function (div) {

                var signInLink = document.createElement('a')
                signInLink.href = 'sign-in/'
                signInLink.className = 'clickable button localNavigation-link'
                ui.Text(signInLink, 'Sign In')

                div.className = 'buttonsWrapper'
                if (response.signUpEnabled) {
                    ui.Element(div, 'div', function (div) {
                        div.className = 'buttonsWrapper-half left'
                        ui.Element(div, 'div', function (div) {
                            div.className = 'buttonsWrapper-limit left'
                            ui.Element(div, 'div', function (div) {
                                div.className = 'buttonWrapper left'
                                div.appendChild(signInLink)
                            })
                        })
                    })
                    ui.Element(div, 'div', function (div) {
                        div.className = 'buttonsWrapper-half right'
                        ui.Element(div, 'div', function (div) {
                            div.className = 'buttonsWrapper-limit right'
                            ui.Element(div, 'div', function (div) {
                                div.className = 'buttonWrapper right'
                                ui.Element(div, 'a', function (a) {
                                    a.href = 'sign-up/'
                                    a.className = 'clickable button localNavigation-link'
                                    ui.Text(a, 'Create an Account')
                                })
                            })
                        })
                    })
                } else {
                    ui.Element(div, 'div', function (div) {
                        div.className = 'buttonsWrapper-limit center'
                        ui.Element(div, 'div', function (div) {
                            div.className = 'buttonWrapper center'
                            div.appendChild(signInLink)
                        })
                    })
                }

            })
            localNavigation.scanLinks()

        }

        return {
            abort: function () {
                request.abort()
            },
        }

    }

    var body = document.body

    localNavigation.registerPage('', loadFunction)

})(localNavigation, ui, revisions)
