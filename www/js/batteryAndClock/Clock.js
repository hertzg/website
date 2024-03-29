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

            var date = new Date(Date.now() + timezoneOffset - difference)

            var hour = pad(date.getUTCHours())
            if (hour !== hourNode.nodeValue) hourNode.nodeValue = hour

            var minute = pad(date.getUTCMinutes())
            if (minuteNode.nodeValue !== minute) minuteNode.nodeValue = minute

            var second = pad(date.getUTCSeconds())
            if (secondNode.nodeValue !== second) secondNode.nodeValue = second

            var utcDate = new Date(date.getTime() - timezoneOffset)
            updateListeners.forEach(function (listener) {
                listener(utcDate, utcDate.getTime())
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

    var timezoneOffset = timezone * 60 * 1000

    var difference
    if (window.localStorage) {
        var lastRemoteTime = parseInt(localStorage.lastRemoteTime, 10)
        if (lastRemoteTime >= remoteTime) {
            difference = parseInt(localStorage.lastLocalTime, 10) - lastRemoteTime
        } else {
            var localTime = Date.now()
            difference = localTime - remoteTime
            try {
                localStorage.lastLocalTime = localTime
                localStorage.lastRemoteTime = remoteTime
            } catch (e) {}
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

    var clockWrapper = document.getElementById('clockWrapper')
    clockWrapper.removeChild(clockWrapper.firstChild)
    clockWrapper.appendChild(hourNode)
    clockWrapper.appendChild(TextNode(':'))
    clockWrapper.appendChild(minuteNode)
    clockWrapper.appendChild(TextNode(':'))
    clockWrapper.appendChild(secondNode)

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
        unUpdate: function (listener) {
            updateListeners.splice(updateListeners.indexOf(listener), 1)
        },
    }

}
