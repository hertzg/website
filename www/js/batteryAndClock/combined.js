(function () {
function Battery (base) {

    function ImageDiv (imageName, alt) {

        var img = document.createElement('img')
        img.alt = alt
        img.src = base + 'images/' + imageName + '.svg'

        var style = img.style
        style.display = 'inline-block'
        style.verticalAlign = 'top'
        style.position = 'absolute'
        style.top = '-1px'
        style.right = style.left = '0'
        style.margin = 'auto'
        style.width = '9px'
        style.height = style.lineHeight = '11px'
        style.backgroundRepeat = 'no-repeat'
        style.color = '#444'
        style.textAlign = 'center'
        style.fontSize = '11px'

        return img
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
        style.lineHeight = '7px'
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

        var chargingElement = ImageDiv('charging', '\u26a1')
        borderElement.appendChild(chargingElement)

        updateCharging()
        updateLevel()

    } else {
        borderElement.appendChild(ImageDiv('question', '?'))
    }

    return {
        unload: function () {
            var battery = navigator.battery
            if (!battery) return
            battery.removeEventListener('chargingchange', updateCharging)
            battery.removeEventListener('levelchange', updateLevel)
        },
    }

}
;
function Clock (remoteTime, timezone) {

    function TextNode (text) {
        return document.createTextNode(text)
    }

    function pad (n) {
        var s = String(n)
        if (n < 10) s = '0' + s
        return s
    }

    function update () {
        var time = Date.now()
        var frame = requestAnimationFrame(function () {

            var date = new Date(Date.now() - difference)

            var hour = pad(date.getUTCHours())
            if (hour !== hourNode.nodeValue) hourNode.nodeValue = hour

            var minute = pad(date.getUTCMinutes())
            if (minuteNode.nodeValue !== minute) minuteNode.nodeValue = minute

            var second = pad(date.getUTCSeconds())
            if (secondNode.nodeValue !== second) secondNode.nodeValue = second

            updateListeners.forEach(function (listener) {
                listener(date, date.getTime() - timezone * 60 * 1000)
            })
            var timeout = setTimeout(update, Math.max(0, time + 1000 - Date.now()))
            unload = function () {
                clearTimeout(timeout)
            }

        })
        unload = function () {
            cancelAnimationFrame(frame)
        }

    }

    var difference
    if (window.localStorage) {
        var lastRemoteTime = parseInt(localStorage.lastRemoteTime, 10)
        if (lastRemoteTime >= remoteTime) {
            difference = parseInt(localStorage.lastLocalTime, 10) - lastRemoteTime
        } else {
            var localTime = Date.now()
            difference = localTime - remoteTime
            localStorage.lastLocalTime = localTime
            localStorage.lastRemoteTime = remoteTime
        }
    } else {
        difference = Date.now() - remoteTime
    }

    var requestAnimationFrame = window.requestAnimationFrame,
        cancelAnimationFrame = window.cancelAnimationFrame
    if (!requestAnimationFrame) {
        requestAnimationFrame = window.mozRequestAnimationFrame
        cancelAnimationFrame = window.mozCancelAnimationFrame
    }
    if (!requestAnimationFrame) {
        requestAnimationFrame = function (callback) {
            return setTimeout(callback, 0)
        }
        cancelAnimationFrame = function (frame) {
            clearTimeout(frame)
        }
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

    update()

    var updateListeners = []

    var unload = null

    return {
        onUpdate: function (listener) {
            updateListeners.push(listener)
        },
        unload: function () {
            unload()
        },
    }

}
;
(function (base, time, timezone, localNavigation) {

    var battery = Battery(base)
    var clock = Clock(time, timezone)

    localNavigation.onUnload(function () {
        battery.unload()
        clock.unload()
    })

    window.batteryAndClock = { onClockUpdate: clock.onUpdate }

})(base, time, timezone, localNavigation)
;

})()