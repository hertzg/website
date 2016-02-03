var localNavigation = (function (base, unloadProgress) {

    function loadPage (href, hash, loadFunction) {

        function unload () {

            unloadProgress.hide()

            var body = document.body
            while (body.lastChild) body.removeChild(body.lastChild)

            var head = document.head
            var childNodes = Array.prototype.slice.call(head.childNodes)
            childNodes.forEach(function (node) {
                var tagName = node.tagName
                if (tagName !== 'TITLE' && tagName !== 'META') {
                    head.removeChild(node)
                }
            })
            console.log(head.childNodes.length)

        }

        return loadFunction(function () {
            currentOperation = null
            history.pushState(null, document.title, href)
            if (hash !== null) location.hash = hash
        }, function () {
            unload()
            // TODO notify user about this failure
            console.log(href + ' failed to load.')
        }, unload)
    }

    function loadScript (src, callback) {

        var script = document.createElement('script')
        script.src = src
        script.onload = callback
        document.body.appendChild(script)

        return {
            abort: function () {
                script.onload = null
            },
        }

    }

    var absoluteBase = (function () {
        var a = document.createElement('a')
        a.href = base
        return a.href
    })()

    var currentOperation = null
    var loadFunctions = Object.create(null)

    var links = document.querySelectorAll('.localNavigation-link')
    Array.prototype.forEach.call(links, function (link) {

        var href = link.href
        var localHref = href.substr(absoluteBase.length)
        var hash = localHref.match(/#.*/)
        if (hash !== null) {
            hash = hash[0]
            localHref = localHref.substr(0, localHref.length - hash.length)
        }

        link.addEventListener('click', function (e) {

            e.preventDefault()
            unloadProgress.show()
            if (currentOperation !== null) currentOperation.abort()

            var loadFunction = loadFunctions[localHref]
            if (loadFunction === undefined) {
                currentOperation = loadScript(absoluteBase + localHref + 'load.js', function () {
                    currentOperation = loadPage(href, hash, loadFunctions[localHref])
                })
            } else {
                currentOperation = loadPage(href, hash, loadFunction)
            }

        })

    })

    return {
        registerPage: function (localHref, loadFunction) {
            loadFunctions[localHref] = loadFunction
        },
    }

})(base, unloadProgress)
