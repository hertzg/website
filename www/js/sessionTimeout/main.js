(function (base) {

    function schedule () {

        function check () {
            var storedTime = localStorage.sessionStartTime
            if (storedTime > time) {
                time = storedTime
                setTimeout(check, interval)
            } else {
                TimeoutDialog(schedule)
            }
        }

        var time = Date.now()
        localStorage.sessionStartTime = time
        setTimeout(check, interval)

    }

    var interval = 5 * 1000
    schedule()

    ExtendSession(base)

})(base)
