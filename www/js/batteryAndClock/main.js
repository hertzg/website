(function (base, time, timezone, localNavigation) {

    var battery = Battery(base)
    var clock = Clock(time, timezone)

    localNavigation.onUnload(function () {
        battery.unload()
        clock.unload()
    })

    window.batteryAndClock = { onClockUpdate: clock.onUpdate }

})(base, time, timezone, localNavigation)
