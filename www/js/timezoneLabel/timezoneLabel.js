(function (batteryAndClock, timezone) {

    function TextNode (text) {
        return document.createTextNode(text)
    }

    function pad (n) {
        if (n < 10) return '0' + n
        return n
    }

    var months = ['January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December']

    var items = []

    var first = true

    var elements = document.querySelectorAll('.localTime')
    Array.prototype.forEach.call(elements, function (element) {

        var hourNode = TextNode(''),
            minuteNode = TextNode(''),
            secondNode = TextNode(''),
            monthNode = TextNode(''),
            dayNode = TextNode('')

        var localTimezone = element.dataset.local_timezone
        var timezoneDiff = (timezone - localTimezone) * 60 * 1000

        items.push({
            init: function () {
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
            },
            update: function (date) {
                date = new Date(date.getTime() - timezoneDiff)
                hourNode.nodeValue = pad(date.getUTCHours())
                minuteNode.nodeValue = pad(date.getUTCMinutes())
                secondNode.nodeValue = pad(date.getUTCSeconds())
                monthNode.nodeValue = months[date.getUTCMonth()]
                dayNode.nodeValue = date.getUTCDate()
            },
        })

    })

    batteryAndClock.onClockUpdate(function (date) {
        if (first) {
            first = false
            items.forEach(function (item) {
                item.init()
            })
        }
        items.forEach(function (item) {
            item.update(date)
        })
    })

})(batteryAndClock, timezone)
