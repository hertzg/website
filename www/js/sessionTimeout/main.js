(function (base) {

    function schedule () {

        function check () {
            var storedTime = localStorage.sessionStartTime
            if (storedTime > time) {
                time = storedTime
                setTimeout(check, interval)
            } else {
                var signOutHref = base + 'sign-out/submit.php'
                var dialog = TimeoutDialog(signOutHref, schedule, function () {
                    if (time == localStorage.sessionStartTime) {
                        location = signOutHref
                    } else {
                        dialog.hide()
                    }
                })
            }
        }

        var time = Date.now()
        localStorage.sessionStartTime = time
        setTimeout(check, interval)

    }

    var interval = 30 * 1000
    schedule()

    ExtendSession(base)

})(base)
