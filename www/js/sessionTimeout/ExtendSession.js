function ExtendSession (base) {

    function schedule () {

        function check () {
            var storedTime = localStorage.sessionExtendTime
            if (storedTime > time) {
                time = storedTime
                setTimeout(check, interval)
            } else {
                var request = new XMLHttpRequest
                request.open('get', base + 'api-call/session/extend')
                request.send()
                request.onload = function () {
                    if (request.status == 400) location.reload()
                    else schedule()
                }
            }
        }

        var time = Date.now()
        localStorage.sessionExtendTime = time
        setTimeout(check, interval)

    }

    var interval = 5 * 60 * 1000
    schedule()

}
