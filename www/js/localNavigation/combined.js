(function () {
function LoadScript (src, loadCallback, errorCallback) {

    console.log('LoadScript', src)

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

}
;
(function (base, loaderRevisions, unloadProgress) {

    function loadHref (href, hash, callback) {

        function callLoader (loader) {
            currentOperation = loader(absoluteBase, function () {
                while (unloadListeners.length > 0) unloadListeners.shift()()
                UnloadPage()
                currentOperation = null
                if (callback !== undefined) callback()
            }, error)
        }

        function error () {
            location = href + hash
        }

        console.log('loadHref', href, hash)

        if (currentOperation !== null) currentOperation.abort()

        var localHref = href.substr(absoluteBase.length)
        var loader = loaders[localHref]
        if (loader === undefined) {
            var src = href + 'load.js'
            var revision = loaderRevisions[localHref]
            if (revision === undefined) error()
            else {
                src += '?' + revision
                currentOperation = LoadScript(src, function () {
                    var loader = loaders[localHref]
                    if (loader === undefined) error()
                    else callLoader(loader)
                }, error)
            }
        } else {
            callLoader(loader)
        }

    }

    function popState (e) {
        console.log('popstate', e.state)
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
                    console.log('history.pushState', document.title, state)
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

    console.log('localNavigation loaded')
    window.localNavigation = {
        scanLinks: scanLinks,
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