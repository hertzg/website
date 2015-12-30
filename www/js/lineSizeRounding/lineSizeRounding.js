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

    var style = document.createElement('style')
    document.head.appendChild(style)

    addEventListener('resize', resize)
    resize()

})()
