(function (base, loaderRevisions, clientRevision, unloadProgress) {

    function loadHref (href, search, hash, callback) {

        function loadData (loader) {
            currentOperation = LoadData(href, search, clientRevision, function (response) {
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
            location = href + search + hash
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

    var scanLinks = ScanLinks(unloadProgress, loadHref)

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

})(base, loaderRevisions, clientRevision, unloadProgress)
