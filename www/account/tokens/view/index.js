(function (deleteHref) {

    var dialogShown = false

    var deleteLink = document.getElementById('deleteLink').firstChild
    deleteLink.addEventListener('click', function (e) {
        e.preventDefault()
        deleteLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete remembered session'
        var questionText = 'Are you sure you want to delete the remembered session?'
        confirmDialog(questionText, yesText, deleteHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteHref)
