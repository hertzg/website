(function () {

    function alertAndRedirect (text) {
        alert(text)
        location = '..'
    }

    document.getElementById('installingMessage').style.display = 'block'

    var mozApps = navigator.mozApps
    if (mozApps) {

        var protocol = location.protocol,
            host = location.host,
            pathname = location.pathname.replace(/help\/install\/$/, ''),
            manifest = protocol + '//' + host + pathname + 'webapp-manifest/'

        var checkRequest = mozApps.checkInstalled(manifest)
        checkRequest.onsuccess = function () {
            if (checkRequest.result) {
                alertAndRedirect('Zvini is already installed on your platform.')
            } else {
                var installRequest = mozApps.install(manifest)
                installRequest.onsuccess = function () {
                    var text = 'Zvini has been installed on your platform.'
                    alertAndRedirect(text)
                }
                installRequest.onerror = function () {
                    var text = 'Failed to install Zvini on your platform.'
                    alertAndRedirect(text)
                }
            }
        }

    } else {
        var text = 'We\'re sorry, Zvini cannot be installed on your platform.'
        alertAndRedirect(text)
    }

})()
