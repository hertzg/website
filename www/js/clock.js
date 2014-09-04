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

    var element = document.createElement('div')
    element.appendChild(hourNode)
    element.appendChild(TextNode(':'))
    element.appendChild(minuteNode)

    var style = element.style
    style.display = 'inline-block'
    style.verticalAlign = 'top'
    style.width = '50px'
    style.fontWeight = 'bold'

    var wrapper = document.querySelector('.page-clockWrapper')
    ;(function (classList) {
        if (!classList.contains('cleared')) {
            while (wrapper.firstChild) wrapper.removeChild(wrapper.firstChild)
            classList.add('cleared')
        }
    })(wrapper.classList)
    wrapper.appendChild(element)

    var difference = Date.now() - time

    setInterval(update, 5000)
    update()

})(time)
