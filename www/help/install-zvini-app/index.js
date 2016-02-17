(function () {

    function alertAndRedirect (text) {
        alert(text)
        location.assign('..')
    }

    document.getElementById('installingMessage').style.display = 'block'

    var mozApps = navigator.mozApps
    if (mozApps) {

        var protocol = location.protocol,
            host = location.host,
            pathname = location.pathname
        pathname = pathname.replace(/help\/install-zvini-app\/$/, '')

        var manifest = protocol + '//' + host + pathname + 'webapp-manifest/'
        var checkRequest = mozApps.checkInstalled(manifest)
        checkRequest.onsuccess = function () {
            if (checkRequest.result) {
                var text = 'Zvini app is already installed on your platform.'
                alertAndRedirect(text)
            } else {
                var installRequest = mozApps.install(manifest)
                installRequest.onsuccess = function () {
                    var text = 'Zvini app has been installed on your platform.'
                    alertAndRedirect(text)
                }
                installRequest.onerror = function () {
                    var text = 'Failed to install Zvini app on your platform.'
                    alertAndRedirect(text)
                }
            }
        }

    } else {
        var text = 'We\'re sorry.' +
            ' Zvini app cannot be installed on your platform.'
        alertAndRedirect(text)
    }

})()
