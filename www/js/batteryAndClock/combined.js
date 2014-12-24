(function () {
(function (base) {

    function ImageDiv (imageName) {

        var div = document.createElement('div')

        var style = div.style
        style.width = '9px'
        style.height = '11px'
        style.backgroundRepeat = 'none'
        style.backgroundImage = 'url(' + base + 'images/' + imageName + '.svg)'
        style.position = 'absolute'
        style.top = '-1px'
        style.right = style.left = '0'
        style.margin = 'auto'

        return div
    }

    function updateLevel () {

        var roundLevel = Math.round(battery.level * 5) / 5
        valueElement.style.width = roundLevel * 100 + '%'

        var color = roundLevel > 0.2 ? '#ccc' : '#ee2020'
        borderElement.style.borderColor = color
        plusElement.style.background = color
        valueElement.style.background = color

    }

    function updateCharging () {
        var display = battery.charging ? 'inline-block' : 'none'
        chargingElement.style.display = display
    }

    var valueElement = document.createElement('div')
    ;(function (style) {
        style.display = 'inline-block'
        style.verticalAlign = 'top'
        style.height = '100%'
        style.backgroundColor = '#ccc'
    })(valueElement.style)

    var plusElement = document.createElement('div')
    ;(function (style) {
        style.position = 'absolute'
        style.top = style.bottom = style.left = '0'
        style.height = '30%'
        style.margin = 'auto'
        style.background = '#ccc'
        style.width = '2px'
    })(plusElement.style)

    var borderElement = document.createElement('div')
    borderElement.appendChild(valueElement)
    ;(function (style) {
        style.textAlign = 'right'
        style.position = 'absolute'
        style.top = style.right = style.bottom = '3px'
        style.left = '2px'
        style.border = '1px solid #ccc'
        style.padding = '1px'
        style.borderRadius = '1px'
    })(borderElement.style)

    var batteryWrapper = document.getElementById('batteryWrapper')
    batteryWrapper.appendChild(plusElement)
    batteryWrapper.appendChild(borderElement)

    var battery = navigator.battery
    if (battery) {

        battery.addEventListener('chargingchange', updateCharging)
        battery.addEventListener('levelchange', updateLevel)

        var chargingElement = ImageDiv('charging')
        borderElement.appendChild(chargingElement)

        updateCharging()
        updateLevel()

    } else {
        borderElement.appendChild(ImageDiv('question'))
    }

})(base)
;
(function (time) {

    function TextNode (text) {
        return document.createTextNode(text)
    }

    function pad (n) {
        if (n < 10) return '0' + n
        return n
    }

    function update () {
        var time = Date.now()
        requestAnimationFrame(function () {

            var date = new Date(Date.now() - difference)

            var hour = pad(date.getUTCHours())
            if (hour != hourNode.nodeValue) hourNode.nodeValue = hour

            var minute = pad(date.getUTCMinutes())
            if (minute != minuteNode.nodeValue) minuteNode.nodeValue = minute

            var second = pad(date.getUTCSeconds())
            if (second != secondNode.nodeValue) secondNode.nodeValue = second

            setTimeout(update, Math.max(0, time + 1000 - Date.now()))

        })

    }

    var requestAnimationFrame = window.requestAnimationFrame
    if (!requestAnimationFrame) {
        requestAnimationFrame = window.mozRequestAnimationFrame
    }

    var hourNode = TextNode('')

    var minuteNode = TextNode('')

    var secondNode = TextNode('')

    var dynamicClockWrapper = document.getElementById('dynamicClockWrapper')
    dynamicClockWrapper.appendChild(hourNode)
    dynamicClockWrapper.appendChild(TextNode(':'))
    dynamicClockWrapper.appendChild(minuteNode)
    dynamicClockWrapper.appendChild(TextNode(':'))
    dynamicClockWrapper.appendChild(secondNode)

    var staticClockWrapper = document.getElementById('staticClockWrapper')
    staticClockWrapper.parentNode.removeChild(staticClockWrapper)

    var difference = Date.now() - time

    update()

})(time)
;

})()