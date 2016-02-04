(function (base) {

    function show () {

        if (progressDiv === null) {

            progressDiv = document.createElement('div')

            var style = progressDiv.style
            style.position = 'fixed'
            style.zIndex = '1'
            style.right = style.bottom = style.left = '0'
            style.height = '4px'
            style.backgroundColor = '#fff'
            style.backgroundImage = 'url(' + base + 'images/progress.svg)'
            style.backgroundPosition = '50% 0'

            var x = 0
            animationInterval = setInterval(function () {
                var value = 'calc(50% + ' + x + 'px) 0'
                progressDiv.style.backgroundPosition = value
                x = (x + 1) % 8
            }, 50)

            body.appendChild(progressDiv)

        }

        if (overlayDiv === null) {

            overlayDiv = document.createElement('div')
            overlayDiv.addEventListener('click', function () {
                body.removeChild(overlayDiv)
                overlayDiv = null
            })

            var style = overlayDiv.style
            style.position = 'fixed'
            style.zIndex = '1'
            style.top = style.right = style.bottom = style.left = '0'
            darkenTimeout = setTimeout(function () {
                style.background = 'rgba(0, 0, 0, 0.5)'
            }, 80)

            body.insertBefore(overlayDiv, progressDiv)

            hintTimeout = setTimeout(function () {

                var noteDiv = document.createElement('div')
                noteDiv.style.position = 'absolute'
                noteDiv.style.right = noteDiv.style.left = '0'
                noteDiv.style.bottom = '4px'
                noteDiv.style.color = '#fff'
                noteDiv.style.textAlign = 'center'
                noteDiv.style.fontSize = '12px'
                noteDiv.style.lineHeight = '24px'
                noteDiv.style.textShadow = '0 0 1px #000'
                noteDiv.style.whiteSpace = 'nowrap'
                noteDiv.style.overflow = 'hidden'
                noteDiv.appendChild(document.createTextNode('Tap to release'))

                overlayDiv.appendChild(noteDiv)

            }, 3000)

        }

    }

    var body = document.body
    var overlayDiv = null, progressDiv = null
    var animationInterval, hintTimeout, darkenTimeout

    addEventListener('beforeunload', show)
    window.unloadProgress = {
        show: show,
        hide: function () {
            clearInterval(animationInterval)
            clearTimeout(hintTimeout)
            clearTimeout(darkenTimeout)
            if (progressDiv !== null) {
                body.removeChild(progressDiv)
                progressDiv = null
            }
            if (overlayDiv !== null) {
                body.removeChild(overlayDiv)
                overlayDiv = null
            }
        },
    }

})(base)
