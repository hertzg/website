(function (batteryAndClock, localNavigation, DateAgo) {

    function clockUpdate (date, time) {
        items.forEach(function (item) {
            item.update(date, time)
        })
    }

    var items = []

    var elements = document.querySelectorAll('.dateAgo')
    Array.prototype.forEach.call(elements, function (element) {

        var node = element.firstChild
        var dataset = element.dataset
        var elementTime = dataset.time * 1000

        items.push({
            update: function (date, time) {
                var newValue = DateAgo(elementTime, time, dataset.uppercase)
                if (node.nodeValue !== newValue) node.nodeValue = newValue
            },
        })

    })

    batteryAndClock.onClockUpdate(clockUpdate)

    localNavigation.onUnload(function () {
        batteryAndClock.unClockUpdate(clockUpdate)
    })

})(batteryAndClock, localNavigation, DateAgo)
