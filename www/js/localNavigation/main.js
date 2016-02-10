(function (base, loaderRevisions, unloadProgress) {

    function loadHref (href, hash, callback) {

        function callLoader (loader) {

            var request = new XMLHttpRequest
            request.open('get', href + 'loader/')
            request.send()
            request.onerror = error
            request.onload = function () {

                if (request.status !== 200) {
                    error()
                    return
                }

                var response = JSON.parse(request.responseText)

                loader(response, function (title) {
                    document.title = title
                    while (unloadListeners.length > 0) unloadListeners.shift()()
                    UnloadPage()
                    currentOperation = null
                    if (callback !== undefined) callback()
                })

            }

            currentOperation = {
                abort: function () {
                    request.abort()
                },
            }

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
                    else callLoader(loader)
                }, error)
            }
        } else {
            callLoader(loader)
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
