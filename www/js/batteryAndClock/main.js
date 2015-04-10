(function (base, time, timezone) {
    Battery(base)
    var clock = Clock(time, timezone)
    window.batteryAndClock = { onClockUpdate: clock.onUpdate }
})(base, time, timezone)
