(function (scale, x, y, viewBoxWidth, viewBoxHeight, maxScale) {

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
        var scalingFactor = getScalingFactor()

        var mapX = (e.clientX - rect.left - rect.width / 2) / scale,
            mapY = -((e.clientY - rect.top - rect.height / 2)) / scale

        mapX *= scalingFactor
        mapY *= scalingFactor

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
        if (deltaY > 0) newScale = scale / 1.3
        else if (deltaY < 0) newScale = scale * 1.3
        newScale = Math.min(maxScale, newScale)

        var mapXY = getMapXY(e)
        x -= (mapXY.x - x) * (1 - newScale / scale)
        y -= (mapXY.y - y) * (1 - newScale / scale)

        scale = newScale

        scaleElement.style.transform = 'scale(' + scale + ')'
        translateElement.style.transform = 'translate(' + -x + 'px, ' + y + 'px)'

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
            translateElement.classList.remove('transition')
            translateElement.style.transform = 'translate(' + -x + 'px, ' + y + 'px)'
        }

        function mouseUp () {
            removeEventListener('mousemove', mouseMove)
            removeEventListener('mouseup', mouseUp)
            translateElement.classList.add('transition')
        }

        var clientX = e.clientX,
            clientY = e.clientY

        e.preventDefault()
        addEventListener('mousemove', mouseMove)
        addEventListener('mouseup', mouseUp)

    })

    var svgElement = document.querySelector('svg')

    var scaleElement = map.querySelector('.map-scale')

    var translateElement = map.querySelector('.map-translate')
    translateElement.classList.add('transition')

})(scale, x, y, viewBoxWidth, viewBoxHeight, maxScale)
