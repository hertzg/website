(function (base) {

    var body = document.body

    var overlayShown = false,
        progressShown = false

    addEventListener('beforeunload', function () {

        if (!overlayShown) {

            var overlayDiv = document.createElement('div')
            overlayDiv.addEventListener('click', function () {
                body.removeChild(overlayDiv)
                overlayShown = false
            })

            var style = overlayDiv.style
            style.position = 'fixed'
            style.top = style.right = style.bottom = style.left = '0'
            style.background = 'rgba(0, 0, 0, 0.5)'

            body.appendChild(overlayDiv)
            overlayShown = true

        }

        if (!progressShown) {

            var progressDiv = document.createElement('div')

            var style = progressDiv.style
            style.position = 'fixed'
            style.right = style.bottom = style.left = '0'
            style.height = '4px'
            style.backgroundColor = '#fff'
            style.backgroundImage = 'url(' + base + 'images/progress.svg)'
            style.backgroundPosition = '50% 0'

            var x = 0
            setInterval(function () {
                progressDiv.style.backgroundPosition = 'calc(50% + ' + x + 'px) 0'
                x = (x + 1) % 8
            }, 50)

            body.appendChild(progressDiv)
            progressShown = true

        }

    })

})(base)
