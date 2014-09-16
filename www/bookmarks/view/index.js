(function (deleteHref) {

    var dialogShown = false

    var deleteButton = document.getElementById('deleteButton').firstChild
    deleteButton.addEventListener('click', function (e) {
        e.preventDefault()
        deleteButton.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete bookmark',
            noText = 'No, return back'
        var questionText = 'Are you sure you want to delete the bookmark?' +
            ' It will be moved to Trash.'
        confirmDialog(questionText, yesText, noText, deleteHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteHref)
