(function () {

    var dialogShown = false

    var deleteAllLink = document.getElementById('deleteAllLink').firstChild
    deleteAllLink.addEventListener('click', function (e) {
        e.preventDefault()
        deleteAllLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete all bar charts'
        var questionText = 'Are you sure you want to delete all the bar charts?'
            + ' They will be moved to Trash.'
        var yesHref = 'delete-all/submit.php'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})()