function ExtendSession (base) {

    function schedule () {

        function check () {
            var storedTime = localStorage.sessionExtendTime
            if (storedTime > time) {
                time = storedTime
                setTimeout(check, interval)
            } else {
                var url = base + 'api-call/session/extend?session_auth=1'
                var request = new XMLHttpRequest
                request.open('get', url)
                request.send()
                request.onload = schedule
            }
        }

        var time = Date.now()
        localStorage.sessionExtendTime = time
        setTimeout(check, interval)

    }

    var interval = 5 * 60 * 1000
    schedule()

}
