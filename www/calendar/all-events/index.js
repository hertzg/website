(function (yesHref) {

    var dialogShown = false

    var deleteAllLink = document.getElementById('deleteAllLink').firstChild
    deleteAllLink.addEventListener('click', function (e) {
        e.preventDefault()
        deleteAllLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete all events'
        var questionText = 'Are you sure you want to delete all the events?' +
            ' They will be moved to Trash.'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteAllHref)
