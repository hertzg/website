(function () {
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
;
function TimeoutDialog (noHref, yesListener, noListener) {

    function hide () {
        removeEventListener('keydown', keydownListener)
        body.removeChild(element)
    }

    function hr () {
        var element = document.createElement('div')
        element.className = 'hr'
        return element
    }

    function imageLink (text, iconName) {

        var iconElement = document.createElement('div')
        iconElement.className = 'icon ' + iconName

        var iconWrapperElement = document.createElement('div')
        iconWrapperElement.className = 'image_link-icon'
        iconWrapperElement.appendChild(iconElement)

        var titleElement = document.createElement('div')
        titleElement.className = 'image_link-title'
        titleElement.appendChild(document.createTextNode(text))

        var contentElement = document.createElement('div')
        contentElement.className = 'image_link-content'
        contentElement.appendChild(titleElement)

        var element = document.createElement('a')
        element.className = 'clickable link image_link'
        element.appendChild(iconWrapperElement)
        element.appendChild(contentElement)

        return element

    }

    function keydownListener (e) {
        if (e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) return
        if (e.keyCode == 27) {
            e.preventDefault()
            noListener()
        }
    }

    var alignerElement = document.createElement('div')
    alignerElement.className = 'confirmDialog-aligner'

    var seconds = 30

    var questionText = 'Your session is about to expire.' +
        ' Whould you like to extend your session?' +
        ' It will automatically sign out in ' + seconds + ' seconds.'

    var textElement = document.createElement('div')
    textElement.className = 'page-text'
    textElement.appendChild(document.createTextNode(questionText))

    var yesLink = imageLink('Yes, extend session', 'yes')
    yesLink.href = location.href
    yesLink.addEventListener('click', function (e) {
        e.preventDefault()
        hide()
        clearTimeout(timeout)
        yesListener()
    })

    var noLink = imageLink('No, sign out', 'no')
    noLink.href = noHref
    noLink.addEventListener('click', function (e) {
        e.preventDefault()
        noListener(noHref)
    })

    var column1Element = document.createElement('div')
    column1Element.className = 'twoColumns-column1'
    column1Element.appendChild(yesLink)

    var column2Element = document.createElement('div')
    column2Element.className = 'twoColumns-column2'
    column2Element.appendChild(noLink)

    var twoColumnsElement = document.createElement('div')
    twoColumnsElement.className = 'twoColumns dynamic'
    twoColumnsElement.appendChild(column1Element)
    twoColumnsElement.appendChild(column2Element)

    var frameElement = document.createElement('div')
    frameElement.className = 'confirmDialog-frame'
    frameElement.appendChild(textElement)
    frameElement.appendChild(hr())
    frameElement.appendChild(twoColumnsElement)

    var element = document.createElement('div')
    element.className = 'confirmDialog'
    element.appendChild(alignerElement)
    element.appendChild(frameElement)

    var body = document.body
    body.appendChild(element)

    addEventListener('keydown', keydownListener)

    var timeout = setTimeout(function () {
        noListener(noHref + '?auto=1')
    }, seconds * 1000)

    return { hide: hide }

}
;
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

})(base)
;

})()