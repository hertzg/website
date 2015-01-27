(function () {

    function register (id) {
        var link = document.getElementById(id)
        link.addEventListener('click', function (e) {

            e.preventDefault()

            var address = protocol + '//' + host + pathname +
                '/handle-protocol/' + id + '/?value=%s'

            navigator.registerProtocolHandler(id, address, 'Open in Zvini')

        })
    }

    document.getElementById('jsContent').style.display = 'block'

    var protocol = location.protocol,
        host = location.host

    var pathname = location.pathname
    pathname = pathname.replace(/help\/install-protocol-handlers\/$/, '')

    register('mailto')
    register('sms')
    register('tel')

})()
