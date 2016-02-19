(function (yesHref) {

    var dialogShown = false

    var link = document.getElementById('delete-all')
    link.addEventListener('click', function (e) {
        e.preventDefault()
        link.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete all contacts'
        var questionText = 'Are you sure you want to delete' +
            ' all the contacts? They will be moved to Trash.'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteAllHref)
