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
            var color = response.themeColor
            if (color !== window.themeColor) {
                var href = 'theme/color/' + color + '/common.css'
                var link = document.getElementById('themeColorLink')
                link.href = base + href + '?' + revisions[href]
                window.themeColor = color
            }
        })()

        ;(function () {
            var brightness = response.themeBrightness
            if (brightness !== window.themeBrightness) {
                var href = 'theme/brightness/' + brightness + '/common.css'
                var link = document.getElementById('themeBrightnessLink')
                link.href = base + href + '?' + revisions[href]
                window.themeBrightness = brightness
            }
        })()

        scroll(0, 0)

    }

}
