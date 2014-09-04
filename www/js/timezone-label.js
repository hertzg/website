(function (time, timezone) {

    function TextNode (text) {
        return document.createTextNode(text)
    }

    function pad (n) {
        if (n < 10) return '0' + n
        return n
    }

    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May',
        'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

    var elements = document.querySelectorAll('.localTime')
    Array.prototype.forEach.call(elements, function (element) {

        function update () {

            var date = new Date(Date.now() - difference)

            var hour = pad(date.getUTCHours())
            if (hour != hourNode.nodeValue) hourNode.nodeValue = hour

            var minute = pad(date.getUTCMinutes())
            if (minute != minuteNode.nodeValue) minuteNode.nodeValue = minute

            var month = months[date.getUTCMonth()]
            if (month != monthNode.nodeValue) monthNode.nodeValue = month

            var day = date.getUTCDate()
            if (day != dayNode.nodeValue) dayNode.nodeValue = day

        }

        var classList = element.classList
        if (classList.contains('processed')) return
        classList.add('processed')

        var hourNode = TextNode(''),
            minuteNode = TextNode(''),
            monthNode = TextNode(''),
            dayNode = TextNode('')

        while (element.firstChild) element.removeChild(element.firstChild)
        element.appendChild(hourNode)
        element.appendChild(TextNode(':'))
        element.appendChild(minuteNode)
        element.appendChild(TextNode(', '))
        element.appendChild(monthNode)
        element.appendChild(TextNode(' '))
        element.appendChild(dayNode)

        var localTimezone = element.dataset.local_timezone
        var difference = Date.now() - time + (timezone - localTimezone) * 60 * 1000

        setInterval(update, 5000)
        update()

    })
})(time, timezone)
