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
