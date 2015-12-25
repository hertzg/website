(function (base) {

    function hideOverlay () {
        if (overlayHidden) return
        wrapper.removeChild(overlayDiv)
        overlayHidden = true
    }

    function hideOverlayAndProgress () {
        hideOverlay()
        wrapper.removeChild(progressDiv)
    }

    var wrapper = document.querySelector('.imageProgress')

    var oldImg = wrapper.firstChild

    var overlayHidden = false

    var newImg = document.createElement('img')
    newImg.src = oldImg.src
    newImg.addEventListener('abort', hideOverlayAndProgress)
    newImg.addEventListener('error', hideOverlayAndProgress)
    newImg.addEventListener('load', hideOverlayAndProgress)

    var className = oldImg.className
    if (className !== '') newImg.className = className

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

    wrapper.removeChild(oldImg)
    wrapper.appendChild(newImg)
    wrapper.appendChild(overlayDiv)
    wrapper.appendChild(progressDiv)

    var x = 0
    setInterval(function () {
        progressDiv.style.backgroundPosition = 'calc(50% + ' + x + 'px) 0'
        x = (x + 1) % 8
    }, 50)

    setTimeout(function () {

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

})(base)
