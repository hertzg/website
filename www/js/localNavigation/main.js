(function (base, loaderRevisions, unloadProgress) {

    function loadHref (href, hash, callback) {

        function error () {
            location = href + hash
        }

        function load () {
            currentOperation = null
            if (callback !== undefined) callback()
            scanLinks()
        }

        console.log('loadHref', href, hash)

        if (currentOperation !== null) currentOperation.abort()

        var localHref = href.substr(absoluteBase.length)
        var loader = loaders[localHref]
        if (loader === undefined) {
            var src = href + 'load.js?' + loaderRevisions[localHref]
            currentOperation = LoadScript(src, function () {
                var loader = loaders[localHref]
                if (loader === undefined) error()
                else currentOperation = loader(absoluteBase, load, error, UnloadPage)
            }, error)
        } else {
            currentOperation = loader(absoluteBase, load, error, UnloadPage)
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
                    console.log('history.pushState', state)
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

    window.localNavigation = {
        registerPage: function (href, loader) {
            loaders[href] = loader
        },
    }

})(base, loaderRevisions, unloadProgress)
