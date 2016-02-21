(function (scale, x, y, maxScale) {

    function endShift () {
        translateElement.classList.add('transition')
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

    function limitXY () {
        x = Math.max(-180, Math.min(180, x))
        y = Math.max(-90, Math.min(90, y))
    }

    function scaleAt (e, newScale) {

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
        updateTranslate()

    }

    function shiftMap (dx, dy) {

        var scalingFactor = getScalingFactor()

        x -= dx / scale * scalingFactor
        y += dy / scale * scalingFactor

        limitXY()

        translateElement.classList.remove('transition')
        updateTranslate()

    }

    function updateTranslate () {
        var transform = 'translate(' + -x + 'px, ' + y + 'px)'
        translateElement.style.transform = transform
    }

    var identifier = null,
        touchX, touchY

    var secondIdentifier = null,
        secondTouchX, secondTouchY

    var map = document.querySelector('.map')
    map.addEventListener('wheel', function (e) {

        e.preventDefault()

        var newScale
        var deltaY = e.deltaY
        if (deltaY > 0) newScale = scale / 1.3
        else if (deltaY < 0) newScale = scale * 1.3
        else return

        scaleAt(e, newScale)

    })
    map.addEventListener('mousedown', function (e) {

        function mouseMove (e) {

            var newClientX = e.clientX,
                newClientY = e.clientY

            shiftMap(newClientX - clientX, newClientY - clientY)

            clientX = newClientX
            clientY = newClientY
            translateElement.classList.remove('transition')
            updateTranslate()

        }

        function mouseUp () {
            removeEventListener('mousemove', mouseMove)
            removeEventListener('mouseup', mouseUp)
            endShift()
        }

        if (e.button !== 0) return

        var clientX = e.clientX,
            clientY = e.clientY

        e.preventDefault()
        addEventListener('mousemove', mouseMove)
        addEventListener('mouseup', mouseUp)

    })
    map.addEventListener('touchstart', function (e) {
        var changedTouches = e.changedTouches
        var touch
        if (identifier === null) {

            touch = changedTouches[0]
            identifier = touch.identifier
            touchX = touch.clientX
            touchY = touch.clientY

            if (changedTouches.length > 1) {
                touch = changedTouches[1]
                secondIdentifier = touch.identifier
                secondTouchX = touch.clientX
                secondTouchY = touch.clientY
            }

        } else if (secondIdentifier === null) {
            touch = changedTouches[0]
            secondIdentifier = touch.identifier
            secondTouchX = touch.clientX
            secondTouchY = touch.clientY
        }
    })
    map.addEventListener('touchmove', function (e) {
        var touches = e.changedTouches
        for (var i = 0; i < touches.length; i++) {
            var touch = touches[i]
            var thisIdentifier = touch.identifier
            if (thisIdentifier === identifier) {
                var newTouchX = touch.clientX,
                    newTouchY = touch.clientY
                if (secondIdentifier === null) {
                    shiftMap(newTouchX - touchX, newTouchY - touchY)
                } else {

                    var oldSpaceX = touchX - secondTouchX,
                        oldSpaceY = touchY - secondTouchY,
                        oldDistance = Math.sqrt(oldSpaceX * oldSpaceX + oldSpaceY * oldSpaceY)

                    var newSpaceX = newTouchX - secondTouchX,
                        newSpaceY = newTouchY - secondTouchY,
                        newDistance = Math.sqrt(newSpaceX * newSpaceX + newSpaceY * newSpaceY)

                    var dx = (newTouchX - touchX) / 2,
                        dy = (newTouchY - touchY) / 2

                    shiftMap(dx, dy)

                    scaleAt({
                        clientX: (secondTouchX + newTouchX) / 2,
                        clientY: (secondTouchY + newTouchY) / 2,
                    }, scale * newDistance / oldDistance)

                }
                touchX = newTouchX
                touchY = newTouchY
            } else if (thisIdentifier === secondIdentifier) {

                var newSecondTouchX = touch.clientX,
                    newSecondTouchY = touch.clientY

                var oldSpaceX = touchX - secondTouchX,
                    oldSpaceY = touchY - secondTouchY,
                    oldDistance = Math.sqrt(oldSpaceX * oldSpaceX + oldSpaceY * oldSpaceY)

                var newSpaceX = touchX - newSecondTouchX,
                    newSpaceY = touchY - newSecondTouchY,
                    newDistance = Math.sqrt(newSpaceX * newSpaceX + newSpaceY * newSpaceY)

                var dx = (newSecondTouchX - secondTouchX) / 2,
                    dy = (newSecondTouchY - secondTouchY) / 2

                shiftMap(dx, dy)

                scaleAt({
                    clientX: (newSecondTouchX + touchX) / 2,
                    clientY: (newSecondTouchY + touchY) / 2,
                }, scale * newDistance / oldDistance)

                secondTouchX = newSecondTouchX
                secondTouchY = newSecondTouchY

            }
        }
    })
    map.addEventListener('touchend', function (e) {
        var touches = e.changedTouches
        for (var i = 0; i < touches.length; i++) {
            var thisIdentifier = touches[i].identifier
            if (thisIdentifier === identifier) {
                if (secondIdentifier === null) {
                    identifier = null
                    endShift()
                } else {
                    identifier = secondIdentifier
                    touchX = secondTouchX
                    touchY = secondTouchY
                    secondIdentifier = null
                }
            } else if (thisIdentifier === secondIdentifier) {
                secondIdentifier = null
            }
        }
    })

    var scaleClass = getScaleClass(scale)

    var svgElement = document.querySelector('svg')

    var scaleElement = map.querySelector('.map-scale')

    var translateElement = map.querySelector('.map-translate')
    translateElement.classList.add('transition')

})(scale, x, y, maxScale)
