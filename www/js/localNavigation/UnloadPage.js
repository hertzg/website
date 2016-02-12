function UnloadPage (response, base, revisions) {

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

    if (response.themeColor !== window.themeColor) {
        var href = 'theme/color/' + response.themeColor + '/common.css'
        var link = document.getElementById('themeColorLink')
        link.href = base + href + '?' + revisions[href]
        window.themeColor = response.themeColor
    }

    if (response.themeBrightness !== window.themeBrightness) {
        var href = 'theme/brightness/' + response.themeBrightness + '/common.css'
        var link = document.getElementById('themeBrightnessLink')
        link.href = base + href + '?' + revisions[href]
        window.themeBrightness = response.themeBrightness
    }

    scroll(0, 0)

}
