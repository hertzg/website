(function () {

    var dialogShown = false

    var emptyLink = document.getElementById('emptyLink').firstChild
    emptyLink.addEventListener('click', function (e) {
        e.preventDefault()
        emptyLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete note'
        var yesHref = 'empty/submit.php'
        var questionText = 'Are you sure you want to delete the note?' +
            ' It will be moved to Trash.'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})()
