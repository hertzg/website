(function (base) {

    var unloaded = false

    addEventListener('beforeunload', function () {

        if (unloaded) return
        unloaded = true

        var progressDiv = document.createElement('div')
        ;(function (style) {
            style.position = 'fixed'
            style.right = style.bottom = style.left = '0'
            style.height = '4px'
            style.backgroundColor = '#aaa'
            style.backgroundImage = 'url(' + base + 'images/progress.svg)'
            style.backgroundPosition = '50% 0'
        })(progressDiv.style)

        var overlayDiv = document.createElement('div')
        ;(function (style) {
            style.position = 'fixed'
            style.top = style.right = style.bottom = style.left = '0'
            style.background = 'rgba(0, 0, 0, 0.5)'
        })(overlayDiv.style)
        overlayDiv.addEventListener('click', function () {
            body.removeChild(overlayDiv)
        })

        var body = document.body
        body.appendChild(overlayDiv)
        body.appendChild(progressDiv)

        var x = 0
        setInterval(function () {
            progressDiv.style.backgroundPosition = 'calc(50% + ' + x + 'px) 0'
            x = (x + 1) % 8
        }, 50)

    })

})(base)
