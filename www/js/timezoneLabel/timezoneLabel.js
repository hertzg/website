(function (time, timezone) {

    function TextNode (text) {
        return document.createTextNode(text)
    }

    function pad (n) {
        if (n < 10) return '0' + n
        return n
    }

    var requestAnimationFrame = window.requestAnimationFrame
    if (!requestAnimationFrame) {
        requestAnimationFrame = window.mozRequestAnimationFrame
    }

    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May',
        'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

    var elements = document.querySelectorAll('.localTime')
    Array.prototype.forEach.call(elements, function (element) {

        function update () {
            var time = Date.now()
            requestAnimationFrame(function () {
                var date = new Date(Date.now() - difference)
                hourNode.nodeValue = pad(date.getUTCHours())
                minuteNode.nodeValue = pad(date.getUTCMinutes())
                secondNode.nodeValue = pad(date.getUTCSeconds())
                monthNode.nodeValue = months[date.getUTCMonth()]
                dayNode.nodeValue = date.getUTCDate()
                setTimeout(update, Math.max(0, time + 1000 - Date.now()))
            })
        }

        var classList = element.classList
        if (classList.contains('processed')) return
        classList.add('processed')

        var hourNode = TextNode(''),
            minuteNode = TextNode(''),
            secondNode = TextNode(''),
            monthNode = TextNode(''),
            dayNode = TextNode('')

        while (element.firstChild) element.removeChild(element.firstChild)
        element.appendChild(hourNode)
        element.appendChild(TextNode(':'))
        element.appendChild(minuteNode)
        element.appendChild(TextNode(':'))
        element.appendChild(secondNode)
        element.appendChild(TextNode(', '))
        element.appendChild(monthNode)
        element.appendChild(TextNode(' '))
        element.appendChild(dayNode)

        var localTimezone = element.dataset.local_timezone
        var timezoneDiff = (timezone - localTimezone) * 60 * 1000
        var difference = Date.now() - time + timezoneDiff

        update()

    })
})(time, timezone)
