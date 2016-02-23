(function (base, localNavigation) {

    function schedule () {

        function check () {
            var storedTime = localStorage.sessionStartTime
            if (storedTime > time) {
                time = storedTime
                checkTimeout = setTimeout(check, interval)
            } else {
                var noHref = base + 'sign-out/submit.php'
                var noListener = function (signOutHref) {
                    if (time == localStorage.sessionStartTime) {
                        location.assign(signOutHref)
                    } else {
                        timeoutDialog.hide()
                        timeoutDialog = null
                    }
                }
                timeoutDialog = TimeoutDialog(noHref, function () {
                    schedule()
                    timeoutDialog = null
                }, noListener)
            }
        }

        var time = Date.now()
        localStorage.sessionStartTime = time
        checkTimeout = setTimeout(check, interval)

    }

    var checkTimeout
    var timeoutDialog = null
    var interval = 30 * 60 * 1000
    schedule()

    ExtendSession(base)

    window.sessionTimeout = {
        extend: function () {
            var time = Date.now()
            localStorage.sessionStartTime = time
            localStorage.sessionExtendTime = time
        },
    }

    localNavigation.onUnload(function () {
        clearTimeout(checkTimeout)
        if (timeoutDialog !== null) timeoutDialog.unload()
        delete window.sessionTimeout
    })

})(base, localNavigation)
