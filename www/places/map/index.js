(function (scale, x, y) {

    var map = document.querySelector('.map')
    map.addEventListener('wheel', function (e) {

        var rect = svgElement.getBoundingClientRect(),
            mapX = (e.clientX - rect.left - rect.width / 2) / scale + x,
            mapY = -((e.clientY - rect.top - rect.height / 2)) / scale + y

        e.preventDefault()

        var newScale
        var deltaY = e.deltaY
        if (deltaY > 0) newScale = scale / 1.1
        else if (deltaY < 0) newScale = scale * 1.1

        x -= (mapX - x) * (1 - newScale / scale)
        y -= (mapY - y) * (1 - newScale / scale)

        scale = newScale

        scaleElement.setAttribute('transform', 'scale(' + scale + ')')
        translateElement.setAttribute('transform', 'translate(' + -x + ', ' + y + ')')

    })
    map.addEventListener('mousemove', function (e) {

        var rect = svgElement.getBoundingClientRect(),
            mapX = (e.clientX - rect.left - rect.width / 2) / scale + x,
            mapY = -((e.clientY - rect.top - rect.height / 2)) / scale + y

//        console.log(mapX, mapY)

    })
    map.addEventListener('mousedown', function (e) {

        function mouseMove (e) {
            var newClientX = e.clientX,
                newClientY = e.clientY
            x -= (newClientX - clientX) / scale
            y += (newClientY - clientY) / scale
            clientX = newClientX
            clientY = newClientY
            translateElement.setAttribute('transform', 'translate(' + -x + ', ' + y + ')')
        }

        function mouseUp () {
            removeEventListener('mousemove', mouseMove)
            removeEventListener('mouseup', mouseUp)
        }

        var rect = svgElement.getBoundingClientRect(),
            mapX = (e.clientX - rect.left - rect.width / 2) / scale + x,
            mapY = -((e.clientY - rect.top - rect.height / 2)) / scale + y

        console.log(mapX, mapY)

        var clientX = e.clientX,
            clientY = e.clientY

        addEventListener('mousemove', mouseMove)
        addEventListener('mouseup', mouseUp)

    })

    var svgElement = document.querySelector('svg')

    var scaleElement = map.querySelector('.map-scale')

    var translateElement = map.querySelector('.map-translate')

})(scale, x, y)
