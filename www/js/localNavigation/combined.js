(function () {
function FocusTarget () {
    var hash = location.hash
    if (hash === '') return
    var id = hash.substr(1)
    var element = document.getElementById(id)
    if (id === null) return
    element.classList.add('target')
    if (element.scrollIntoView) element.scrollIntoView()
}
;
function LoadData (href, loadCallback, errorCallback) {

    var request = new XMLHttpRequest
    request.open('get', href + 'loader/')
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
function UnloadPage () {

    unloadProgress.hide()

    var body = document.body
    var nodes = Array.prototype.slice.call(body.childNodes)
    nodes.forEach(function (node) {
        if (node.classList.contains('localNavigation-leave')) return
        body.removeChild(node)
    })

    var head = document.head
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

    scroll(0, 0)

}
;
(function (base, loaderRevisions, unloadProgress) {

    function loadHref (href, hash, callback) {

        function loadData (loader) {
            currentOperation = LoadData(href, function (response) {
                loader(response, function (title) {
                    document.title = title
                    while (unloadListeners.length > 0) unloadListeners.shift()()
                    UnloadPage()
                    currentOperation = null
                    if (callback !== undefined) callback()
                })
            }, error)
        }

        function error () {
            location = href + hash
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
        loadHref(state.href, state.hash)
    }

    function scanLinks () {
        var links = document.querySelectorAll('.localNavigation-link')
        Array.prototype.forEach.call(links, function (link) {

            var href = link.href
            var hash = href.match(/(?:#.*)?$/)[0]
            if (hash !== '') href = href.substr(0, href.length - hash.length)

            link.addEventListener('click', function (e) {

                e.preventDefault()
                unloadProgress.show()

                loadHref(href, hash, function () {
                    var state = {
                        href: href,
                        hash: hash,
                    }
                    history.pushState(state, document.title, href + hash)
                })

            })

        })
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
        hash: location.hash,
    }

    addEventListener('popstate', popState)
    scanLinks()

    var unloadListeners = []

    window.localNavigation = {
        scanLinks: scanLinks,
        focusTarget: FocusTarget,
        registerPage: function (href, loader) {
            loaders[href] = loader
        },
        onUnload: function (listener) {
            unloadListeners.push(listener)
        },
    }

})(base, loaderRevisions, unloadProgress)
;

})()