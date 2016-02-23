(function (base, time, timezone, localNavigation) {

    var battery = Battery(base)
    var clock = Clock(time, timezone)

    window.batteryAndClock = {
        onClockUpdate: clock.onUpdate,
        unClockUpdate: clock.unUpdate,
    }

    localNavigation.onUnload(function () {
        battery.unload()
        clock.unload()
        delete window.batteryAndClock
    })

})(base, time, timezone, localNavigation)
