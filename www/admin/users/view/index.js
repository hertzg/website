(function (yesHref) {

    var dialogShown = false

    var deleteLink = document.getElementById('deleteLink').firstChild
    deleteLink.addEventListener('click', function (e) {
        e.preventDefault()
        deleteLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete user'
        var questionText = 'Are you sure you want to delete the user?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteHref)
