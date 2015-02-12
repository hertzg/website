(function () {

    function formatNumber (number, digits) {
        var s = number.toFixed(digits)
        return s.replace(/(\.\d*?)0+$/, '$1').replace(/\.$/, '')
    }

    var wakelock = WakeLock()

    var dialogShown = false

    var geolocation = navigator.geolocation

    var geolocationLink = document.getElementById('geolocationLink')
    geolocationLink.addEventListener('click', function (e) {

        function hide () {
            geolocation.clearWatch(watchId)
            removeEventListener('keydown', keydownListener)
            body.removeChild(element)
            dialogShown = false
            wakelock.unlock()
        }

        function hr () {
            var element = document.createElement('div')
            element.className = 'hr'
            return element
        }

        function imageLink (text, iconName) {

            var iconElement = document.createElement('div')
            iconElement.className = 'icon ' + iconName

            var iconWrapperElement = document.createElement('div')
            iconWrapperElement.className = 'image_link-icon'
            iconWrapperElement.appendChild(iconElement)

            var titleElement = document.createElement('div')
            titleElement.className = 'image_link-title'
            titleElement.appendChild(document.createTextNode(text))

            var contentElement = document.createElement('div')
            contentElement.className = 'image_link-content'
            contentElement.appendChild(titleElement)

            var element = document.createElement('a')
            element.className = 'clickable link image_link'
            element.appendChild(iconWrapperElement)
            element.appendChild(contentElement)

            return {
                element: element,
                titleElement: titleElement,
            }

        }

        function keydownListener (e) {
            if (e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) return
            if (e.keyCode == 27) {
                e.preventDefault()
                hide()
            }
        }

        e.preventDefault()
        wakelock.lock()

        if (dialogShown) return
        dialogShown = true

        var percentNode = document.createTextNode('0')

        var alignerElement = document.createElement('div')
        alignerElement.className = 'confirmDialog-aligner'

        var latitudeNode = document.createTextNode(''),
            longitudeNode = document.createTextNode(''),
            altitudeNode = document.createTextNode('')

        var positionElement = document.createElement('div')
        positionElement.appendChild(document.createTextNode('Latitude: '))
        positionElement.appendChild(latitudeNode)
        positionElement.appendChild(document.createElement('br'))
        positionElement.appendChild(document.createTextNode('Longitude: '))
        positionElement.appendChild(longitudeNode)
        positionElement.appendChild(document.createElement('br'))
        positionElement.appendChild(document.createTextNode('Altitude: '))
        positionElement.appendChild(altitudeNode)

        var accuiringNode = document.createTextNode('Accuiring location... ')

        var textElement = document.createElement('div')
        textElement.className = 'page-text'
        textElement.appendChild(accuiringNode)
        textElement.appendChild(percentNode)
        textElement.appendChild(document.createTextNode('%'))

        var okLink = imageLink('Use the location', 'yes')
        okLink.titleElement.classList.add('disabled')

        var cancelLink = imageLink('Cancel', 'no')
        cancelLink.element.addEventListener('click', function (e) {
            e.preventDefault()
            hide()
        })

        var column1Element = document.createElement('div')
        column1Element.className = 'twoColumns-column1'
        column1Element.appendChild(okLink.element)

        var column2Element = document.createElement('div')
        column2Element.className = 'twoColumns-column2'
        column2Element.appendChild(cancelLink.element)

        var twoColumnsElement = document.createElement('div')
        twoColumnsElement.className = 'twoColumns dynamic'
        twoColumnsElement.appendChild(column1Element)
        twoColumnsElement.appendChild(column2Element)

        var frameElement = document.createElement('div')
        frameElement.className = 'confirmDialog-frame'
        frameElement.appendChild(textElement)
        frameElement.appendChild(hr())
        frameElement.appendChild(twoColumnsElement)

        var element = document.createElement('div')
        element.className = 'confirmDialog'
        element.appendChild(alignerElement)
        element.appendChild(frameElement)

        var body = document.body
        body.appendChild(element)

        addEventListener('keydown', keydownListener)

        var positions = []
        var maxPositions = 40,
            enoughPositions = 10

        var latitude, longitude

        var watchId = geolocation.watchPosition(function (position) {

            positions.push(position)

            var numPositions = positions.length

            if (numPositions > maxPositions) {
                positions.shift()
                numPositions--
            }

            var percent = numPositions * 100 / maxPositions
            percentNode.nodeValue = Math.floor(percent)

            if (numPositions < enoughPositions) return

            if (numPositions == enoughPositions) {
                textElement.appendChild(positionElement)
                okLink.titleElement.classList.remove('disabled')
                okLink.element.addEventListener('click', function (e) {

                    function setValue (name, value) {
                        var selector = 'input[name=' + name + ']'
                        document.querySelector(selector).value = value
                    }

                    e.preventDefault()
                    hide()

                    setValue('latitude', formatNumber(latitude, 9))
                    setValue('longitude', formatNumber(longitude, 9))
                    setValue('altitude', formatNumber(altitude, 3))

                })
            }

            var accuracy = 0,
                altitudeAccuracy = 9
            positions.forEach(function (position) {
                var coords = position.coords
                accuracy += coords.accuracy
                altitudeAccuracy += coords.altitudeAccuracy
            })

            latitude = 0
            longitude = 0
            altitude = 0
            positions.forEach(function (position) {

                var coords = position.coords
                var multiplier

                multiplier = coords.accuracy / accuracy
                latitude += coords.latitude * multiplier
                longitude += coords.longitude * multiplier

                multiplier = coords.altitudeAccuracy / altitudeAccuracy
                altitude += coords.altitude * multiplier

            })

            latitudeNode.nodeValue = formatNumber(latitude, 9)
            longitudeNode.nodeValue = formatNumber(longitude, 9)
            altitudeNode.nodeValue = formatNumber(altitude, 3)

        }, function () {
        }, {
            enableHighAccuracy: true,
        })

    })
})()
