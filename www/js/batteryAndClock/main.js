(function (base, time, timezone) {

    var batteryAndClock = window.batteryAndClock
    if (batteryAndClock) {
        console.log('batteryAndClock already loaded reloading')
        batteryAndClock.reload()
        return
    }

    var battery = Battery(base)
    var clock = Clock(time, timezone)

    window.batteryAndClock = {
        onClockUpdate: clock.onUpdate,
        reload: function () {
            console.log('batteryAndClock.reload')
            var parentNode = document.querySelector('.page-clockWrapper')
            battery.reload(parentNode)
            clock.reload(parentNode)
        },
    }

})(base, time, timezone)
