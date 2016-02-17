(function () {

    function resize () {
        var lineWidth = Math.floor(devicePixelRatio) / devicePixelRatio + 'px'
        style.innerHTML =
            '.hr,' +
            '.barChart-line {' +
                'height: ' + lineWidth +
            '}' +
            '.twoColumns-column2 {' +
                'border-left-width: ' + lineWidth +
            '}' +
            '.page_tabs-tab.normal { border-bottom-width: ' + lineWidth + ' }'
    }

    var lineSizeRounding = window.lineSizeRounding
    if (lineSizeRounding) return

    var style = document.createElement('style')
    style.type = 'text/css'

    var head = document.head
    head.appendChild(style)

    addEventListener('resize', resize)
    resize()

    window.lineSizeRounding = {}

})()
