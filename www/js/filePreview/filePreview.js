(function (base) {

    var previewElement = document.querySelector('.preview')

    var firstChild = previewElement.firstChild

    var tagName = firstChild.tagName
    if (tagName == 'IMG') {

        function hideOverlay () {
            if (overlayHidden) return
            wrapper.removeChild(overlayDiv)
            overlayHidden = true
        }

        var overlayHidden = false

        var oldImg = firstChild

        var newImg = document.createElement('img')
        newImg.src = oldImg.src
        newImg.addEventListener('load', function () {
            hideOverlay()
            wrapper.removeChild(progressDiv)
        })
        ;(function (style) {
            style.display = 'inline-block'
            style.verticalAlign = 'top'
            style.maxWidth = '100%'
            style.maxHeight = '150px'
        })(newImg.style)

        var progressDiv = document.createElement('div')
        ;(function (style) {
            style.position = 'absolute'
            style.right = style.bottom = style.left = '0'
            style.backgroundColor = '#fff'
            style.backgroundImage = 'url(' + base + 'images/progress.svg)'
            style.backgroundPosition = '50% 0'
            style.height = '4px'
        })(progressDiv.style)

        var overlayDiv = document.createElement('div')
        overlayDiv.addEventListener('click', hideOverlay)
        ;(function (style) {
            style.position = 'absolute'
            style.top = style.right = style.bottom = style.left = '0'
            style.background = 'rgba(0, 0, 0, 0.5)'
        })(overlayDiv.style)

        var wrapper = document.createElement('div')
        wrapper.appendChild(newImg)
        wrapper.appendChild(overlayDiv)
        wrapper.appendChild(progressDiv)
        ;(function (style) {
            style.display = 'inline-block'
            style.verticalAlign = 'top'
            style.maxWidth = '100%'
            style.maxHeight = '150px'
            style.position = 'relative'
        })(wrapper.style)

        previewElement.removeChild(oldImg)
        previewElement.appendChild(wrapper)

        var x = 0
        setInterval(function () {
            progressDiv.style.backgroundPosition = 'calc(50% + ' + x + 'px) 0'
            x = (x + 1) % 8
        }, 50)

    }

})(base)
