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

            function updateIcon (size) {
                var href = 'theme/color/' + color + '/images/icon' + size + '.png'
                var link = document.getElementById('icon' + size + 'Link')
                link.href = base + href + '?' + revisions[href]
            }

            var color = response.themeColor
            if (color === window.themeColor) return
            window.themeColor = color

            var href = 'theme/color/' + color + '/common.css'
            var link = document.getElementById('themeColorLink')
            link.href = base + href + '?' + revisions[href]

            updateIcon(16)
            updateIcon(32)
            updateIcon(48)
            updateIcon(64)
            updateIcon(90)
            updateIcon(120)
            updateIcon(128)
            updateIcon(256)
            updateIcon(512)

        })()

        ;(function () {

            var brightness = response.themeBrightness
            if (brightness !== window.themeBrightness) return
            window.themeBrightness = brightness

            var href = 'theme/brightness/' + brightness + '/common.css'
            var link = document.getElementById('themeBrightnessLink')
            link.href = base + href + '?' + revisions[href]

        })()

        scroll(0, 0)

    }

}
