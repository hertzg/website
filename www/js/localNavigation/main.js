(function (base, unloadProgress) {

    function loadHref (state, callback) {

        function finish (newBase) {
            base = newBase
            currentOperation = null
            if (callback !== undefined) callback()
            if (hash !== '') {
                removeEventListener('popstate', popState)
                location.hash = hash
                addEventListener('popstate', popState)
            }
            scanLinks()
        }

        console.log('loadHref', state)

        var href = state.href
        var hash = state.hash

        if (currentOperation !== null) currentOperation.abort()
        var loader = loaders[href]
        if (loader === undefined) {
            currentOperation = LoadScript(absoluteBase + href + 'load.js', function () {
                if (loaders[href] === undefined) {
                    location = absoluteBase + href + hash
                } else {
                    currentOperation = LoadPage(base, href, loaders[href], finish)
                }
            }, function () {
                location = absoluteBase + href + hash
            })
        } else {
            currentOperation = LoadPage(base, href, loader, finish)
        }

    }

    function popState (e) {
        console.log('popstate', e.state)
        var state = e.state
        if (state === null) state = initialState
        absoluteBase = AbsoluteBase(state.base)
        loadHref(state)
    }

    function scanLinks () {
        var links = document.querySelectorAll('.localNavigation-link')
        Array.prototype.forEach.call(links, function (link) {

            var linkHref = link.href
            var href = linkHref.substr(absoluteBase.length)
            var hash = href.match(/(?:#.*)?$/)[0]
            if (hash !== '') href = href.substr(0, href.length - hash.length)

            var state = {
                base: base,
                href: href,
                hash: hash,
            }

            link.addEventListener('click', function (e) {
                e.preventDefault()
                unloadProgress.show()
                loadHref(state, function () {
                    console.log('history.pushState', state)
                    history.pushState(state, document.title, linkHref)
                    absoluteBase = AbsoluteBase(base)
                })
            })

        })
    }

    var currentOperation = null
    var loaders = Object.create(null)

    var absoluteBase = AbsoluteBase(base)

    var initialState = {
        base: base,
        href: location.href.substr(absoluteBase.length).replace(/#.*?$/, ''),
        hash: location.hash,
    }

    addEventListener('popstate', popState)
    scanLinks()

    window.localNavigation = {
        registerPage: function (href, loader) {
            loaders[href] = loader
        },
    }

})(base, unloadProgress)
