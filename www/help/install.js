(function () {

    function alertAndRedirect (text) {
        alert(text)
        location = './'
    }

    var mozApps = navigator.mozApps
    if (mozApps) {
        var pathname = location.pathname.replace(/help\/install\.php$/, '')
        var manifest = location.protocol + '//' + location.host + pathname + 'manifest.php'
        var checkRequest = mozApps.checkInstalled(manifest)
        checkRequest.onsuccess = function () {
            if (checkRequest.result) {
                alertAndRedirect('Zvini is already installed on your platform.')
            } else {
                var installRequest = mozApps.install(manifest)
                installRequest.onsuccess = function () {
                    alertAndRedirect('Zvini has been installed on your platform.')
                }
                installRequest.onerror = function () {
                    alertAndRedirect('Failed to install Zvini on your platform.')
                }
            }
        }
    } else {
        alertAndRedirect('We\'re sorry, Zvini cannot be installed on your platform.')
    }

})()
