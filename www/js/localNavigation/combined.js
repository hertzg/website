(function () {
function LoadPage (href, loader, callback) {

    function unload () {

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

    console.log('LoadPage', href)

    return loader(callback, function () {
        unload()
        // TODO notify user about this failure
        console.log(href + ' failed to load.')
        callback()
    }, unload)

}
;
function LoadScript (src, loadCallback, errorCallback) {

    console.log('LoadScript', src)
    var script = document.createElement('script')
    script.src = src
    script.onload = loadCallback
    script.onerror = errorCallback
    document.body.appendChild(script)

    return {
        abort: function () {
            script.onload = null
        },
    }

}
;
(function (base, unloadProgress) {

    function loadHref (state, callback) {

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
                    currentOperation = LoadPage(href, loaders[href], function () {
                        currentOperation = null
                        callback()
                    })
                }
            }, function () {
                location = absoluteBase + href + hash
            })
        } else {
            currentOperation = LoadPage(href, loader, function () {
                currentOperation = null
                callback()
            })
        }

    }

    var currentOperation = null
    var loaders = Object.create(null)

    var absoluteBase = (function () {
        var a = document.createElement('a')
        a.href = base
        return a.href
    })()

    var initialState = {
        href: location.href.substr(absoluteBase.length).replace(/#.*?$/, ''),
        hash: location.hash,
    }

    var links = document.querySelectorAll('.localNavigation-link')
    Array.prototype.forEach.call(links, function (link) {

        var linkHref = link.href
        var href = linkHref.substr(absoluteBase.length)
        var hash = href.match(/(?:#.*)?$/)[0]
        if (hash !== '') href = href.substr(0, href.length - hash.length)

        var state = {
            href: href,
            hash: hash,
        }

        link.addEventListener('click', function (e) {
            e.preventDefault()
            unloadProgress.show()
            loadHref(state, function () {
                console.log('history.pushState', state)
                history.pushState(state, document.title, linkHref)
            })
        })

    })

    addEventListener('popstate', function (e) {
        console.log('popstate', e.state)
        var state = e.state
        if (state === null) state = initialState
        loadHref(state)
    })

    window.localNavigation = {
        registerPage: function (href, loader) {
            loaders[href] = loader
        },
    }

})(base, unloadProgress)
;

})()