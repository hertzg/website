(function (batteryAndClock, localNavigation) {

    function clockUpdate (date) {
        dayElement.innerHTML = date.getUTCDate()
    }

    var dayElement = document.querySelector('.calendarIcon-day')
    batteryAndClock.onClockUpdate(clockUpdate)

    localNavigation.onUnload(function () {
        batteryAndClock.unClockUpdate(clockUpdate)
    })

})(batteryAndClock, localNavigation)
