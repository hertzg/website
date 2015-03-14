(function (scale, x, y, maxScale) {

    function limitXY () {
        x = Math.max(-180, Math.min(180, x))
        y = Math.max(-90, Math.min(90, y))
    }

    function getScaleClass (scale) {
        var index = 0
        while (scale > 2) {
            scale /= 2
            index++
        }
        return 'scale' + index
    }

    function getScalingFactor () {

        var rect = svgElement.getBoundingClientRect(),
            width = rect.width,
            height = rect.height

        if (width / height > 360 / 180) {
            return 180 / height
        }
        return 360 / width

    }

    function getMapXY (e, scale) {

        var rect = svgElement.getBoundingClientRect()
        var scalingFactor = getScalingFactor()

        var mapX = (e.clientX - rect.left - rect.width / 2) / scale,
            mapY = -((e.clientY - rect.top - rect.height / 2)) / scale

        mapX = mapX * scalingFactor + x
        mapY = mapY * scalingFactor + y

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
        else return
        newScale = Math.max(1, Math.min(maxScale, newScale))

        var mapXY = getMapXY(e, newScale)
        x -= (mapXY.x - x) * (1 - newScale / scale)
        y -= (mapXY.y - y) * (1 - newScale / scale)
        limitXY()

        scale = newScale

        svgElement.classList.remove(scaleClass)
        scaleClass = getScaleClass(scale)
        svgElement.classList.add(scaleClass)

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

            limitXY()

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

        if (e.button !== 0) return

        var clientX = e.clientX,
            clientY = e.clientY

        e.preventDefault()
        addEventListener('mousemove', mouseMove)
        addEventListener('mouseup', mouseUp)

    })

    var scaleClass = getScaleClass(scale)

    var svgElement = document.querySelector('svg')

    var scaleElement = map.querySelector('.map-scale')

    var translateElement = map.querySelector('.map-translate')
    translateElement.classList.add('transition')

})(scale, x, y, maxScale)
