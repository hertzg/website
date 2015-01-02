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
            hourNode.nodeValue = pad(date.getUTCHours())
            minuteNode.nodeValue = pad(date.getUTCMinutes())
            secondNode.nodeValue = pad(date.getUTCSeconds())
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
