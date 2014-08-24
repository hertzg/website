(function () {

    function pad (n) {
        if (n < 10) return '0' + n
        return n
    }

    function update () {
        var date = new Date
        hourNode.nodeValue = pad(date.getHours())
        minuteNode.nodeValue = pad(date.getMinutes())
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

    setInterval(update, 1000)
    update()

})()
