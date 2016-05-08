(function () {

    var dialogShown = false

    var restoreLink = document.getElementById('restore-defaults')
    restoreLink.addEventListener('click', function (e) {
        e.preventDefault()
        restoreLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, restore defaults'
        var yesHref = 'restore-defaults/submit.php'
        var questionText = 'Are you sure you want to restore' +
            ' the default visibility of the items?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})()
