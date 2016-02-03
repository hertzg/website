(function (base, localNavigation) {

    function add (parentNode, tagName, callback) {
        var element = document.createElement(tagName)
        parentNode.appendChild(element)
        callback(element)
    }

    function addText (element, text) {
        element.appendChild(document.createTextNode(text))
    }

    function loadFunction (loadCallback, errorCallback, unload) {

        var request = new XMLHttpRequest
        request.open('get', base + 'home/load.php')
        request.send()
        request.onerror = errorCallback
        request.onload = function () {

            if (request.status !== 200) {
                errorCallback()
                return
            }

            var response = JSON.parse(request.responseText)

            unload()
            document.title = 'Home'
            add(body, 'div', function (div) {
                div.id = 'tbar'
                add(div, 'div', function (div) {
                    div.id = 'tbar-limit'
                    add(div, 'a', function (a) {
                        a.className = 'topLink logoLink'
                        add(a, 'img', function (img) {
                            img.alt = 'Zvini'
                            img.className = 'logoLink-img'
                            img.src = base + response.logoSrc
                        })
                    })
                    add(div, 'div', function (div) {
                        div.className = 'page-clockWrapper'
                        add(div, 'div', function (div) {
                            div.id = 'staticClockWrapper'
                            addText(div, '00:00:00')
                        })
                    })
                    add(div, 'div', function (div) {
                        div.className = 'pageTopRightLinks'
                        add(div, 'a', function (a) {
                            a.id = 'signOutLink'
                            a.className = 'topLink'
                            a.href = base + 'sign-out/'
                            addText(a, 'Sign Out')
                        })
                    })
                })
            })
            add(body, 'div', function (div) {
                div.className = 'tab-content'
            })
            add(body, 'div', function (div) {
                div.className = 'panel'
                add(div, 'div', function (div) {
                    div.className = 'panel-title'
                    add(div, 'div', function (div) {
                        div.className = 'panel-title-text'
                        addText(div, 'Options')
                        add(div, 'span', function (span) {
                            addText(span, ':')
                        })
                    })
                })
                add(div, 'div', function (div) {
                    div.className = 'panel-content'
                    add(div, 'div', function (div) {
                        div.className = 'twoColumns'
                        add(div, 'div', function (div) {
                            div.className = 'twoColumns-column1 dynamic'
                        })
                        add(div, 'div', function (div) {
                            div.className = 'twoColumns-column2 dynamic'
                            add(div, 'a', function (a) {
                                a.name = 'customize'
                            })
                            add(div, 'a', function (a) {
                                a.id = 'customize'
                                a.className = 'clickable link image_link withArrow'
                                a.href = '../help/'
                                add(a, 'span', function (span) {
                                    span.className = 'image_link-icon'
                                    add(span, 'span', function (span) {
                                        span.className = 'icon help'
                                    })
                                })
                                add(a, 'span', function (span) {
                                    span.className = 'image_link-content'
                                    addText(span, 'Help')
                                })
                            })
                        })
                    })
                })
            })
            loadCallback()

        }

        return {
            abort: function () {
                request.abort()
            },
        }

    }

    var body = document.body

    localNavigation.registerPage('home/', loadFunction)

})(base, localNavigation)
