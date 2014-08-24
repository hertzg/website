(function () {

    function update () {

        var roundLevel = Math.round(battery.level * 5) / 5
        valueElement.style.width = roundLevel * 100 + '%'

        var color = roundLevel > 0.2 ? '#ccc' : '#ee2020'
        borderElement.style.borderColor = color
        plusElement.style.background = color
        valueElement.style.background = color

    }

    var valueElement = document.createElement('div')
    ;(function (style) {
        style.position = 'absolute'
        style.top = style.right = style.bottom = '0'
        style.backgroundColor = '#ccc'
    })(valueElement.style)

    var plusElement = document.createElement('div')
    ;(function (style) {
        style.position = 'absolute'
        style.top = style.bottom = style.left = '0'
        style.height = '30%'
        style.margin = 'auto'
        style.background = '#ccc'
        style.width = '3px'
        style.borderRadius = '1px 0 0 1px'
    })(plusElement.style)

    var borderElement = document.createElement('div')
    borderElement.appendChild(valueElement)
    ;(function (style) {
        style.position = 'absolute'
        style.top = style.right = style.bottom = style.left = '3px'
        style.border = '1.5px solid #ccc'
        style.padding = '1.5px'
        style.borderRadius = '2px'
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

    document.body.appendChild(element)

    var battery = navigator.battery
    battery.addEventListener('levelchange', update)
    update()

})()
