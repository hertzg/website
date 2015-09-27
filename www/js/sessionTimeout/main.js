(function (base) {

    function schedule () {

        function check () {
            var storedTime = localStorage.sessionStartTime
            if (storedTime > time) {
                time = storedTime
                setTimeout(check, interval)
            } else {
                var noHref = base + 'sign-out/submit.php'
                var noListener = function (signOutHref) {
                    if (time == localStorage.sessionStartTime) {
                        location = signOutHref
                    } else {
                        dialog.hide()
                    }
                }
                var dialog = TimeoutDialog(noHref, schedule, noListener)
            }
        }

        var time = Date.now()
        localStorage.sessionStartTime = time
        setTimeout(check, interval)

    }

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

})(base)
