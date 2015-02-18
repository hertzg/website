(function (base, time) {
    Battery(base)
    var clock = Clock(time)
    window.batteryAndClock = { onClockUpdate: clock.onUpdate}
})(base, time)
