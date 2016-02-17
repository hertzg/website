(function (base, timeoutSeconds) {

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
        var signOutHref = base + 'sign-out/submit.php'
        confirmDialog(questionText, yesText, signOutHref, function () {
            dialogShown = false
            clearTimeout(timeout)
        })
        dialogShown = true
        timeout = setTimeout(function () {
            location.assign(signOutHref + '?auto=1')
        }, timeoutSeconds * 1000)
    })

})(base, signOutTimeout)
