(function (time) {

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

    var hourNode = document.createTextNode('00')

    var minuteNode = document.createTextNode('00')

    var element = document.createElement('div')
    element.appendChild(hourNode)
    element.appendChild(document.createTextNode(':'))
    element.appendChild(minuteNode)

    var style = element.style
    style.position = 'absolute'
    style.top = '0'
    style.right = '50%'
    style.color = '#ccc'
    style.fontFamily = 'monospace'
    style.fontWeight = 'bold'
    style.fontSize = '12px'
    style.lineHeight = '48px'
    style.width = '50px'
    style.textAlign = 'right'
    style.paddingRight = '4px'

    document.body.appendChild(element)

    var difference = Date.now() - time

    setInterval(update, 1000)
    update()

})(time)
