(function (base, localNavigation) {

    function add (parentNode, tagName, callback) {
        var element = document.createElement(tagName)
        parentNode.appendChild(element)
        callback(element)
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

            unload()
            document.title = 'Home'
            add(document.head, 'title', function (title) {
                title.appendChild(document.createTextNode('Home'))
            })
            add(document.head, 'meta', function (title) {
                title.appendChild(document.createTextNode('Home'))
            })
            add(document.body, 'div', function (div) {
                div.id = 'tbar'
                add(div, 'div', function (div) {
                    div.id = 'tbar-limit'
                    add(div, 'a', function (a) {
                        a.className = 'topLink logoLink'
                        add(a, 'img', function (img) {
                            img.alt = 'Zvini'
                            img.className = 'logoLink-img'
                        })
                    })
                })
/*
                ."<a class=\"\" href=\"$logo_href\">"
                    ."<img src=\"$base$logoSrc?".get_revision($logoSrc).'" />'
                    .$notifications
                .'</a>'
                .'<div class="page-clockWrapper">'
                    .'<div id="staticClockWrapper">'
                        .date('H:i:s', $time / 1000)
                    .'</div>'
                    .'<div id="batteryWrapper"></div>'
                    .'<div id="dynamicClockWrapper"></div>'
                .'</div>'
                .$signOutLink
*/
            })
            add(document.body, 'div', function (div) {
                div.className = 'tab-content'
                console.log(div)
            })
            loadCallback()

        }

        return {
            abort: function () {
                request.abort()
            },
        }

    }

    localNavigation.registerPage('home/', loadFunction)

})(base, localNavigation)
