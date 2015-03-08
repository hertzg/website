(function () {

    var map = document.querySelector('.map')
    map.addEventListener('wheel', function (e) {
        e.preventDefault()
        var deltaY = e.deltaY
        if (deltaY > 0) scale /= 1.05
        else if (deltaY < 0) scale *= 1.05
        zoom.setAttribute('transform', 'scale(' + scale + ')')
    })

    var zoom = map.querySelector('.map-zoom')
    var scale = zoom.getAttribute('transform').match(/scale\((.*)\)/)[1]

})()
