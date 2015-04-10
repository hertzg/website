(function (batteryAndClock) {

    function DateAgo (time, timeNow, uppercase) {

        function DateAgo (time, timeNow) {

            var seconds = Math.floor((timeNow - time) / 1000)

            var minutes = Math.floor(seconds / 60)
            if (!minutes) return 'just now'
            if (minutes <= 1) return 'a minute ago'
            if (minutes == 30) return 'half an hour ago'

            var hours = Math.floor(minutes / 60)
            if (!hours) return minutes + ' minutes ago'
            if (hours == 1) return 'an hour ago'

            var days = Math.floor(hours / 24)
            if (!days) return hours + ' hours ago'
            if (days == 1) return 'yesterday'

            var months = Math.floor(days / 30)
            if (!months) return days + ' days ago'
            if (months == 1) return 'a month ago'

            var years = Math.floor(months / 12)
            if (!years) return months + ' months ago'
            if (years == 1) return 'a year ago'

            return years + ' years ago'

        }

        var value = DateAgo(time, timeNow)
        if (uppercase) {
            value = value.substr(0, 1).toUpperCase() + value.substr(1)
        }
        return value

    }

    var items = []

    var elements = document.querySelectorAll('.dateAgo')
    Array.prototype.forEach.call(elements, function (element) {

        var node = element.firstChild
        var dataset = element.dataset
        var elementTime = dataset.time * 1000

        items.push({
            update: function (date, time) {
                node.nodeValue = DateAgo(elementTime, time, dataset.uppercase)
            },
        })

    })
    batteryAndClock.onClockUpdate(function (date, time) {
        items.forEach(function (item) {
            item.update(date, time)
        })
    })

})(batteryAndClock)
