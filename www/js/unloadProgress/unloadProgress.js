(function (base) {

    var unloaded = false

    addEventListener('beforeunload', function () {

        if (unloaded) return
        unloaded = true

        var div = document.createElement('div')
        ;(function (style) {
            style.position = 'absolute'
            style.top = style.right = style.left = '0'
            style.height = '2px'
            style.backgroundColor = '#aaa'
            style.backgroundImage = 'url(' + base + 'images/progress.svg)'
            style.backgroundPosition = '50% 0'
        })(div.style)

        document.body.appendChild(div)

        var x = 0
        setInterval(function () {
            div.style.backgroundPosition = 'calc(50% + ' + x + 'px) 0'
            x = (x + 1) % 8
        }, 50)

    })

})(base)
