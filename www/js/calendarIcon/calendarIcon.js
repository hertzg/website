(function (batteryAndClock) {
    var currentDay = document.getElementById('currentDay')
    batteryAndClock.onClockUpdate(function (date) {
        currentDay.innerHTML = date.getDate()
    })
})(batteryAndClock)
