(function (base) {

    function updateLevel () {

        var roundLevel = Math.round(battery.level * 5) / 5
        valueElement.style.width = roundLevel * 100 + '%'

        var color = roundLevel > 0.2 ? '#ccc' : '#ee2020'
        borderElement.style.borderColor = color
        plusElement.style.background = color
        valueElement.style.background = color

    }

    function updateCharging () {
        chargingElement.style.display = battery.charging ? 'inline-block' : 'none'
    }

    var battery = navigator.battery
    if (!battery) return
    battery.addEventListener('chargingchange', updateCharging)
    battery.addEventListener('levelchange', updateLevel)

    var valueElement = document.createElement('div')
    ;(function (style) {
        style.display = 'inline-block'
        style.verticalAlign = 'top'
        style.height = '100%'
        style.backgroundColor = '#ccc'
    })(valueElement.style)

    var plusElement = document.createElement('div')
    ;(function (style) {
        style.position = 'absolute'
        style.top = style.bottom = style.left = '0'
        style.height = '30%'
        style.margin = 'auto'
        style.background = '#ccc'
        style.width = '2px'
    })(plusElement.style)

    var chargingElement = document.createElement('div')
    ;(function (style) {
        style.width = '9px'
        style.height = '11px'
        style.backgroundRepeat = 'none'
        style.backgroundImage = 'url(' + base + 'images/charging.svg)'
        style.position = 'absolute'
        style.top = '-1px'
        style.right = style.left = '0'
        style.margin = 'auto'
    })(chargingElement.style)

    var borderElement = document.createElement('div')
    borderElement.appendChild(valueElement)
    borderElement.appendChild(chargingElement)
    ;(function (style) {
        style.textAlign = 'right'
        style.position = 'absolute'
        style.top = style.right = style.bottom = '3px'
        style.left = '2px'
        style.border = '1px solid #ccc'
        style.padding = '1px'
        style.borderRadius = '1px'
    })(borderElement.style)

    var element = document.createElement('div')
    element.appendChild(plusElement)
    element.appendChild(borderElement)
    ;(function (style) {
        style.position = 'absolute'
        style.top = '15px'
        style.left = '50%'
        style.color = '#fff'
        style.fontFamily = 'monospace'
        style.fontSize = '12px'
        style.width = '30px'
        style.height = '17px'
        style.textAlign = 'center'
    })(element.style)

    var wrapper = document.querySelector('.page-clockWrapper')
    if (!wrapper.classList.contains('cleared')) {
        while (wrapper.firstChild) wrapper.removeChild(wrapper.firstChild)
        wrapper.classList.add('cleared')
    }
    wrapper.appendChild(element)

    updateCharging()
    updateLevel()

})(base)
