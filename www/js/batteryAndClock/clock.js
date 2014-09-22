(function (time) {

    function TextNode (text) {
        return document.createTextNode(text)
    }

    function pad (n) {
        if (n < 10) return '0' + n
        return n
    }

    function update () {

        var date = new Date(Date.now() - difference)

        var hour = pad(date.getUTCHours())
        if (hour != hourNode.nodeValue) hourNode.nodeValue = hour

        var minute = pad(date.getUTCMinutes())
        if (minute != minuteNode.nodeValue) minuteNode.nodeValue = minute

    }

    var hourNode = TextNode('')

    var minuteNode = TextNode('')

    var dynamicClockWrapper = document.getElementById('dynamicClockWrapper')
    dynamicClockWrapper.appendChild(hourNode)
    dynamicClockWrapper.appendChild(TextNode(':'))
    dynamicClockWrapper.appendChild(minuteNode)

    var staticClockWrapper = document.getElementById('staticClockWrapper')
    staticClockWrapper.parentNode.removeChild(staticClockWrapper)

    var difference = Date.now() - time

    setInterval(update, 5000)
    update()

})(time)
