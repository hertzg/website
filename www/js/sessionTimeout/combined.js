(function () {
function ExtendSession (base) {

    function schedule () {

        function check () {

            var storedTime = time
            try {
                storedTime = localStorage.sessionExtendTime
            } catch (e) {
            }

            if (storedTime > time) {
                time = storedTime
                setTimeout(check, interval)
            } else {
                var request = new XMLHttpRequest
                request.open('get', base + 'api-call/session/extend?session_auth=1')
                request.send()
                request.onload = schedule
            }

        }

        var time = Date.now()
        try {
            localStorage.sessionExtendTime = time
        } catch (e) {
        }

        setTimeout(check, interval)

    }

    var interval = 5 * 60 * 1000
    schedule()

}
;
(function (base) {
    ExtendSession(base)
})(base)
;

})()