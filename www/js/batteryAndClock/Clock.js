function Clock (remoteTime, timezone) {

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
            hourNode.nodeValue = pad(date.getUTCHours())
            minuteNode.nodeValue = pad(date.getUTCMinutes())
            secondNode.nodeValue = pad(date.getUTCSeconds())
            updateListeners.forEach(function (listener) {
                listener(date, date.getTime() - timezone * 60 * 1000)
            })
            setTimeout(update, Math.max(0, time + 1000 - Date.now()))
        })

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

    var requestAnimationFrame = window.requestAnimationFrame
    if (!requestAnimationFrame) {
        requestAnimationFrame = window.mozRequestAnimationFrame
    }
    if (!requestAnimationFrame) {
        requestAnimationFrame = function (callback) {
            setTimeout(callback, 0)
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

    return {
        onUpdate: function (listener) {
            updateListeners.push(listener)
        },
    }

}
