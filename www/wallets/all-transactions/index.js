(function (yesHref) {

    var dialogShown = false

    var link = document.getElementById('delete-all')
    link.addEventListener('click', function (e) {
        e.preventDefault()
        link.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete all transactions'
        var questionText = 'Are you sure you want' +
            ' to delete all the transactions?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteAllHref)
