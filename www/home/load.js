(function (base, localNavigation) {

    function Page_emptyTabs (parentNode, callback) {
        addZeroHeightBr(parentNode)
        add(parentNode, 'div', function (div) {
            div.className = 'tab-content'
            callback(div)
        })
    }

    function Page_imageArrowLink (parentNode,
        title, href, iconName, options, callback) {

        options.className = 'withArrow'
        Page_imageLink(parentNode, title, href, iconName, options, callback)

    }

    function Page_imageLink (parentNode,
        title, href, iconName, options, callback) {

        add(parentNode, 'a', function (a) {
            a.name = options.id
        })
        add(parentNode, 'a', function (a) {

            var additionalClass
            if (options.className === undefined) additionalClass = ''
            else additionalClass = ' ' + options.className
            if (options.localNavigation !== undefined) {
                additionalClass += ' localNavigation-link'
            }

            a.id = options.id
            a.className = 'clickable link image_link' + additionalClass
            a.href = href
            add(a, 'span', function (span) {
                span.className = 'image_link-icon'
                add(span, 'span', function (span) {
                    span.className = 'icon ' + iconName
                })
            })
            add(a, 'span', function (span) {
                span.className = 'image_link-content'
                addText(span, title)
            })

        })

    }

    function Page_panel (parentNode, title, callback) {
        addZeroHeightBr(parentNode)
        add(parentNode, 'div', function (div) {
            div.className = 'panel'
            add(div, 'div', function (div) {
                div.className = 'panel-title'
                add(div, 'div', function (div) {
                    div.className = 'panel-title-text'
                    addText(div, title)
                    add(div, 'span', function (span) {
                        span.className = 'zeroSize'
                        addText(span, ':')
                    })
                })
            })
            add(div, 'div', function (div) {
                div.className = 'panel-content'
                callback(div)
            })
        })
    }

    function Page_twoColumns (parentNode, column1Callback, column2Callback) {
        add(parentNode, 'div', function (div) {
            div.className = 'twoColumns'
            add(div, 'div', function (div) {
                div.className = 'twoColumns-column1 dynamic'
                column1Callback(div)
            })
            add(div, 'div', function (div) {
                div.className = 'twoColumns-column2 dynamic'
                column2Callback(div)
            })
        })
    }

    function add (parentNode, tagName, callback) {
        var element = document.createElement(tagName)
        parentNode.appendChild(element)
        callback(element)
    }

    function addHr (parentNode) {
        var div = document.createElement('div')
        div.className = 'hr'
        parentNode.appendChild(div)
    }

    function addText (element, text) {
        element.appendChild(document.createTextNode(text))
    }

    function addZeroHeightBr (parentNode) {
        add(parentNode, 'br', function (br) {
            br.className = 'zeroHeight'
        })
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
                        a.href = '../'
                        add(a, 'img', function (img) {
                            img.alt = 'Zvini'
                            img.className = 'logoLink-img'
                            img.src = base + response.logoSrc
                        })
                    })
                    add(div, 'div', function (div) {
                        div.className = 'page-clockWrapper'
                        add(div, 'div', function (div) {
                            div.id = 'batteryWrapper'
                        })
                        add(div, 'div', function (div) {
                            div.id = 'dynamicClockWrapper'
                            addText(div, '00:00:00')
                        })
                    })
                    add(div, 'div', function (div) {
                        div.className = 'pageTopRightLinks'
                        add(div, 'a', function (a) {
                            a.id = 'signOutLink'
                            a.className = 'topLink'
                            a.href = '../sign-out/'
                            addText(a, 'Sign Out')
                        })
                    })
                })
            })
            Page_emptyTabs(body, function (div) {
            })
            Page_panel(body, 'Options', function (div) {
                Page_twoColumns(div, function (div) {
                    Page_imageArrowLink(div, 'Account',
                        '../account/', 'account', { id: 'account' })
                }, function (div) {
                    Page_imageArrowLink(div, 'Customize Home',
                        'customize/', 'edit-home', { id: 'customize' })
                })
                addHr(div)
                Page_imageArrowLink(div, 'Help', '../help/', 'help', {
                    id: 'help',
                    localNavigation: true,
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
