(function () {
function FocusTarget () {

    var hash = location.hash
    if (hash === '') return

    var id = hash.substr(1)
    var element = document.getElementById(id)
    if (id === null) return

    element.classList.add('target')
    element.scrollIntoView()

}
;
function LoadData (href, search, clientRevision, loadCallback, errorCallback) {

    var queryString
    if (search === '') queryString = '?'
    else queryString = search + '&'
    queryString += 'client_revision=' + clientRevision

    var request = new XMLHttpRequest
    request.open('get', href + 'loader/' + queryString)
    request.send()
    request.onerror = errorCallback
    request.onload = function () {

        if (request.status !== 200) {
            errorCallback()
            return
        }

        var response
        try {
            response = JSON.parse(request.responseText)
        } catch (e) {
            errorCallback()
            return
        }

        loadCallback(response)

    }

    return {
        abort: function () {
            request.abort()
        },
    }

}
;
function LoadScript (src, loadCallback, errorCallback) {

    var script = document.createElement('script')
    script.type = 'text/javascript'
    script.src = src
    script.onload = loadCallback
    script.onerror = errorCallback

    document.body.appendChild(script)

    return {
        abort: function () {
            script.onload = script.onerror = null
        },
    }

}
;
function ScanLinks (unloadProgress, loadHref) {
    return function () {
        var links = document.querySelectorAll('.localNavigation-link')
        Array.prototype.forEach.call(links, function (link) {

            var href = link.href

            var hash = href.match(/(?:#.*)?$/)[0]
            if (hash !== '') {
                href = href.substr(0, href.length - hash.length)
            }

            var search = href.match(/(?:\?.*)?$/)[0]
            if (search !== '') {
                href = href.substr(0, href.length - search.length)
            }

            link.addEventListener('click', function (e) {

                e.preventDefault()
                unloadProgress.show()

                loadHref(href, search, hash, function () {
                    history.pushState({
                        href: href,
                        search: search,
                        hash: hash,
                    }, document.title, href + search + hash)
                })

            })

        })
    }
}
;
function UnloadPage (unloadProgress, base, revisions) {

    var body = document.body,
        head = document.head

    return function (response) {

        unloadProgress.hide()

        ;(function () {
            var nodes = Array.prototype.slice.call(body.childNodes)
            nodes.forEach(function (node) {
                if (node.classList.contains('localNavigation-leave')) return
                body.removeChild(node)
            })
        })()

        ;(function () {
            var nodes = Array.prototype.slice.call(head.childNodes)
            nodes.forEach(function (node) {
                var tagName = node.tagName
                if (tagName === 'TITLE' || tagName === 'META') return
                if (tagName === 'LINK') {
                    if (node.rel === 'icon' ||
                        node.classList.contains('localNavigation-leave')) {

                        return

                    }
                }
                head.removeChild(node)
            })
        })()

        ;(function () {

            function updateIcon (size) {
                var href = 'theme/color/' + color + '/images/icon' + size + '.png'
                var link = document.getElementById('icon' + size + 'Link')
                link.href = base + href + '?' + revisions[href]
            }

            var color = response.themeColor
            if (color === window.themeColor) return
            window.themeColor = color

            var href = 'theme/color/' + color + '/common.css'
            var link = document.getElementById('themeColorLink')
            link.href = base + href + '?' + revisions[href]

            updateIcon(16)
            updateIcon(32)
            updateIcon(48)
            updateIcon(64)
            updateIcon(90)
            updateIcon(120)
            updateIcon(128)
            updateIcon(256)
            updateIcon(512)

        })()

        ;(function () {

            var brightness = response.themeBrightness
            if (brightness !== window.themeBrightness) return
            window.themeBrightness = brightness

            var href = 'theme/brightness/' + brightness + '/common.css'
            var link = document.getElementById('themeBrightnessLink')
            link.href = base + href + '?' + revisions[href]

        })()

        scroll(0, 0)

    }

}
;
(function (base, revisions, loaderRevisions, clientRevision, unloadProgress) {

    function loadHref (href, search, hash, callback) {

        function error () {
            location.assign(href + search + hash)
        }

        function loadData (loader) {
            currentOperation = LoadData(href, search, clientRevision, function (response) {
                loader(response, function (title) {
                    document.title = title
                    while (unloadListeners.length > 0) unloadListeners.shift()()
                    unloadPage(response)
                    currentOperation = null
                    if (callback !== undefined) callback()
                })
            }, error)
        }

        if (currentOperation !== null) currentOperation.abort()

        var localHref = href.substr(absoluteBase.length)
        var loader = loaders[localHref]
        if (loader === undefined) {
            var src = href + 'loader/index.js'
            var revision = loaderRevisions[localHref]
            if (revision === undefined) error()
            else {
                src += '?' + revision
                currentOperation = LoadScript(src, function () {
                    var loader = loaders[localHref]
                    if (loader === undefined) error()
                    else loadData(loader)
                }, error)
            }
        } else {
            loadData(loader)
        }

    }

    function popState (e) {
        var state = e.state
        if (state === null) state = initialState
        loadHref(state.href, state.search, state.hash)
    }

    var currentOperation = null
    var loaders = Object.create(null)

    var absoluteBase = (function () {
        var a = document.createElement('a')
        a.href = base
        return a.href
    })()

    var initialState = {
        href: location.href,
        search: location.search,
        hash: location.hash,
    }

    var unloadListeners = []

    var unloadPage = UnloadPage(unloadProgress, absoluteBase, revisions)

    var scanLinks = ScanLinks(unloadProgress, loadHref)

    scanLinks()

    addEventListener('load', function () {
        setTimeout(function () {
            addEventListener('popstate', popState)
        }, 0)
    })

    window.localNavigation = {
        focusTarget: FocusTarget,
        scanLinks: scanLinks,
        onUnload: function (listener) {
            unloadListeners.push(listener)
        },
        registerPage: function (href, loader) {
            loaders[href] = loader
        },
    }

})(base, revisions, loaderRevisions, clientRevision, unloadProgress)
;

})()