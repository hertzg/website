(function (scale, x, y) {

    var map = document.querySelector('.map')
    map.addEventListener('wheel', function (e) {
        e.preventDefault()
        var deltaY = e.deltaY
        if (deltaY > 0) scale /= 1.1
        else if (deltaY < 0) scale *= 1.1
        zoom.setAttribute('transform', 'scale(' + scale + ')')
    })
    map.addEventListener('mousedown', function (e) {

        function mouseMove (e) {
            var newClientX = e.clientX,
                newClientY = e.clientY
            console.log((newClientX - clientX) / scale)
            x += (newClientX - clientX) / scale / 2.222
            y += (newClientY - clientY) / scale / 2.222
            clientX = newClientX
            clientY = newClientY
            translate.setAttribute('transform', 'translate(' + x + ', ' + y + ')')
        }

        function mouseUp () {
            removeEventListener('mousemove', mouseMove)
            removeEventListener('mouseup', mouseUp)
        }

        var clientX = e.clientX,
            clientY = e.clientY

        addEventListener('mousemove', mouseMove)
        addEventListener('mouseup', mouseUp)

    })

    var zoom = map.querySelector('.map-zoom')

    var translate = map.querySelector('.map-translate')

})(scale, x, y)
