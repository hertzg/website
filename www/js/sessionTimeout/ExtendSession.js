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
                    var status = request.status
                    if (status == 400) {
                        var response = JSON.parse(request.responseText)
                        if (response == 'SESSION_INVALID') {
                            location.reload()
                        } else {
                            // TODO handle other error
                        }
                    } else {
                        schedule()
                    }
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
