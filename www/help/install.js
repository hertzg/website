;(function () {
    var mozApps = navigator.mozApps
    if (mozApps) {
        var manifest = location.protocol + '//' + location.host + location.pathname.replace(/help\/install\.php$/, '') + 'manifest.php'
        var checkRequest = mozApps.checkInstalled(manifest)
        checkRequest.onsuccess = function () {
            if (checkRequest.result) {
                alert('Zvini is already installed on your platform.');
                location = './'
            } else {
                var installRequest = mozApps.install(manifest)
                installRequest.onsuccess = function () {
                    alert('Zvini has been installed on your platform.');
                    location = './'
                }
                installRequest.onerror = function () {
                    alert('Failed to install Zvini on your platform.');
                    location = './'
                }
            }
        }
    } else {
        alert('We\'re sorry, Zvini cannot be installed on your platform.');
        location = './'
    }
})()
