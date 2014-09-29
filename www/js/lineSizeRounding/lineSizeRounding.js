(function () {

    function resize () {
        var lineWidth = Math.floor(devicePixelRatio) / devicePixelRatio + 'px'
        style.innerHTML =
            '.hr { height: ' + lineWidth + ' }' +
            '.tab-spacer { border-bottom-width: ' + lineWidth + ' }' +
            '.twoColumns > *:last-child {' +
                ' border-left-width:' + lineWidth +
            ' }' +
            '.panel > .title { border-bottom-width:' + lineWidth + ' }'
    }

    var style = document.createElement('style')
    document.head.appendChild(style)

    addEventListener('resize', resize)
    resize()

})()
