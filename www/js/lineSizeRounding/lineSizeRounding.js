(function () {

    function resize () {
        var lineWidth = Math.floor(devicePixelRatio) / devicePixelRatio + 'px'
        style.innerHTML =
            '.hr { height: ' + lineWidth + ' }' +
            '.tab-spacer { border-bottom-width: ' + lineWidth + ' }' +
            '.twoColumns-column2 {' +
                ' border-left-width:' + lineWidth +
            ' }' +
            '.panel > .title { border-bottom-width:' + lineWidth + ' }' +
            '.barChart-line { height: ' + lineWidth + ' }'
    }

    var style = document.createElement('style')
    document.head.appendChild(style)

    addEventListener('resize', resize)
    resize()

})()
