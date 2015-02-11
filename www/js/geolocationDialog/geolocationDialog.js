(function () {

    var dialogShown = false

    var geolocation = navigator.geolocation

    var geolocationLink = document.getElementById('geolocationLink')
    geolocationLink.addEventListener('click', function (e) {

        function clearWatch () {
            if (watchId === null) return
            geolocation.clearWatch(watchId)
            watchId = null
        }

        function hide () {
            clearWatch()
            removeEventListener('keydown', keydownListener)
            body.removeChild(element)
            dialogShown = false
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

        if (dialogShown) return
        dialogShown = true

        var percentNode = document.createTextNode('0')

        var alignerElement = document.createElement('div')
        alignerElement.className = 'confirmDialog-aligner'

        var latitudeNode = document.createTextNode('')

        var longitudeNode = document.createTextNode('')

        var positionElement = document.createElement('div')
        positionElement.appendChild(document.createTextNode('Latitude: '))
        positionElement.appendChild(latitudeNode)
        positionElement.appendChild(document.createElement('br'))
        positionElement.appendChild(document.createTextNode('Longitude: '))
        positionElement.appendChild(longitudeNode)

        var textElement = document.createElement('div')
        textElement.className = 'page-text'
        textElement.appendChild(document.createTextNode('Accuiring location... '))
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
        var maxPositions = 20,
            enoughPositions = 5

        var latitude, longitude

        var watchId = geolocation.watchPosition(function (position) {

            positions.push(position)
            var numPositions = positions.length

            var percent = numPositions * 100 / maxPositions
            percentNode.nodeValue = Math.floor(percent)

            if (numPositions >= enoughPositions) {

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

                        setValue('longitude', longitude)
                        setValue('latitude', latitude)

                    })
                }

                var accuracySum = 0
                positions.forEach(function (position) {
                    accuracySum += position.coords.accuracy
                })

                latitude = 0
                longitude = 0
                positions.forEach(function (position) {
                    var coords = position.coords,
                        multiplier = coords.accuracy / accuracySum
                    latitude += coords.latitude * multiplier
                    longitude += coords.longitude * multiplier
                })

                latitudeNode.nodeValue = latitude
                longitudeNode.nodeValue = longitude

            }

            if (numPositions == maxPositions) clearWatch()

        }, function () {
        }, {
            enableHighAccuracy: true,
        })

    })
})()
