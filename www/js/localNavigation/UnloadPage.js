function UnloadPage (unloadProgress, absoluteBase, revisions) {

    var body = document.body,
        head = document.head

    return function (response) {

        unloadProgress.hide()

        while (body.lastChild) body.removeChild(body.lastChild)

        ;(function () {
            var nodes = Array.prototype.slice.call(head.childNodes)
            nodes.forEach(function (node) {
                var tagName = node.tagName
                if (tagName === 'TITLE' || tagName === 'META' || tagName === 'STYLE') return
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
                var pathname = 'theme/color/' + color + '/images/icon' + size + '.png'
                var link = document.getElementById('icon' + size + 'Link')
                link.href = absoluteBase + pathname + '?' + revisions[pathname]
            }

            var color = response.themeColor
            window.themeColor = color

            var pathname = 'theme/color/' + color + '/common.css'
            var link = document.getElementById('themeColorLink')
            link.href = absoluteBase + pathname + '?' + revisions[pathname]

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
            window.themeBrightness = brightness

            var pathname = 'theme/brightness/' + brightness + '/common.css'
            var link = document.getElementById('themeBrightnessLink')
            link.href = absoluteBase + pathname + '?' + revisions[pathname]

        })()

        scroll(0, 0)

    }

}
