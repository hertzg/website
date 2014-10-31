(function (yesHref, timeoutSeconds) {

    var timeout
    var dialogShown = false

    var signOutLink = document.getElementById('signOutLink')
    signOutLink.addEventListener('click', function (e) {
        e.preventDefault()
        signOutLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, sign out'
        var questionText = 'Are you sure you want to sign out?' +
            ' It will automatically sign out in ' + timeoutSeconds + ' seconds.'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
            clearTimeout(timeout)
        })
        dialogShown = true
        timeout = setTimeout(function () {
            location = yesHref
        }, timeoutSeconds * 1000)
    })

})(signOutHref, signOutTimeout)
