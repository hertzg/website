(function (batteryAndClock) {
    var dayElement = document.querySelector('.calendarIcon-day')
    batteryAndClock.onClockUpdate(function (date) {
        dayElement.innerHTML = date.getUTCDate()
    })
})(batteryAndClock)
