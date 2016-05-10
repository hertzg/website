function Battery (base) {

    function updateLevel () {

        var roundLevel = Math.round(battery.level * 5) / 5
        valueElement.style.width = roundLevel * 100 + '%'

        if (roundLevel > 0.2) {
            borderClassList.remove('low')
            plusClassList.remove('low')
            valueClassList.remove('low')
        } else {
            borderClassList.add('low')
            plusClassList.add('low')
            valueClassList.add('low')
        }

    }

    function updateCharging () {
        if (battery.charging) chargingClassList.remove('hidden')
        else chargingClassList.add('hidden')
    }

    var valueElement = document.createElement('div')
    valueElement.className = 'battery-value'

    var valueClassList = valueElement.classList

    var plusElement = document.querySelector('.battery-plus')

    var plusClassList = plusElement.classList

    var borderElement = document.querySelector('.battery-border')
    borderElement.appendChild(valueElement)

    var borderClassList = borderElement.classList

    var battery = navigator.battery
    if (battery) {

        battery.addEventListener('chargingchange', updateCharging)
        battery.addEventListener('levelchange', updateLevel)

        var chargingElement = document.querySelector('.battery-image')
        chargingElement.src = base + 'images/charging.svg'
        chargingElement.alt = '\u26a1'

        var chargingClassList = chargingElement.classList

        updateCharging()
        updateLevel()

    }

    return {
        unload: function () {
            var battery = navigator.battery
            if (!battery) return
            battery.removeEventListener('chargingchange', updateCharging)
            battery.removeEventListener('levelchange', updateLevel)
        },
    }

}
