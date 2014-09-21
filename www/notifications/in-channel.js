(function (yesHref) {

    var dialogShown = false

    var deleteLink = document.getElementById('deleteLink').firstChild
    deleteLink.addEventListener('click', function (e) {
        e.preventDefault()
        deleteLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete notifications'
        var questionText = 'Are you sure you want to delete' +
            ' notifications in this channel?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteHref)
