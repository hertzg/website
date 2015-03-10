(function (scale, x, y, viewBoxWidth, viewBoxHeight) {

    function getScalingFactor () {

        var rect = svgElement.getBoundingClientRect(),
            width = rect.width,
            height = rect.height

        if (width / height > viewBoxWidth / viewBoxHeight) {
            return viewBoxHeight / height
        }
        return viewBoxWidth / width

    }

    function getMapXY (e) {

        var rect = svgElement.getBoundingClientRect()

        var mapX = (e.clientX - rect.left - rect.width / 2) / scale,
            mapY = -((e.clientY - rect.top - rect.height / 2)) / scale

        mapX *= rect.width / viewBoxWidth
        mapY *= rect.height / viewBoxHeight

        mapX += x
        mapY += y

        return {
            x: mapX,
            y: mapY,
        }

    }

    var map = document.querySelector('.map')
    map.addEventListener('wheel', function (e) {

        e.preventDefault()

        var newScale
        var deltaY = e.deltaY
        if (deltaY > 0) newScale = scale / 1.1
        else if (deltaY < 0) newScale = scale * 1.1

        var mapXY = getMapXY(e)
        x -= (mapXY.x - x) * (1 - newScale / scale)
        y -= (mapXY.y - y) * (1 - newScale / scale)

        scale = newScale

        scaleElement.setAttribute('transform', 'scale(' + scale + ')')
        translateElement.setAttribute('transform', 'translate(' + -x + ', ' + y + ')')

    })
    map.addEventListener('mousedown', function (e) {

        function mouseMove (e) {
            var rect = svgElement.getBoundingClientRect()
            var newClientX = e.clientX,
                newClientY = e.clientY
            var scalingFactor = getScalingFactor()
            x -= (newClientX - clientX) / scale * scalingFactor
            y += (newClientY - clientY) / scale * scalingFactor
            clientX = newClientX
            clientY = newClientY
            translateElement.setAttribute('transform', 'translate(' + -x + ', ' + y + ')')
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

    var svgElement = document.querySelector('svg')
    console.log(viewBoxHeight / svgElement.getBoundingClientRect().height)

    var scaleElement = map.querySelector('.map-scale')

    var translateElement = map.querySelector('.map-translate')

})(scale, x, y, viewBoxWidth, viewBoxHeight)
