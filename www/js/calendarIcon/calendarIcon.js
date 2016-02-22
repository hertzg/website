(function (batteryAndClock, localNavigation) {

    function clockUpdate (date) {
        var day = date.getUTCDate().toString()
        if (day !== dayNode.nodeValue) dayNode.nodeValue = day
    }

    var dayElement = document.querySelector('.calendarIcon-day')
    var dayNode = dayElement.firstChild
    batteryAndClock.onClockUpdate(clockUpdate)

    localNavigation.onUnload(function () {
        batteryAndClock.unClockUpdate(clockUpdate)
    })

})(batteryAndClock, localNavigation)
