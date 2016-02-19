(function (yesHref) {

    var dialogShown = false

    var link = document.getElementById('delete')
    link.addEventListener('click', function (e) {
        e.preventDefault()
        link.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete bookmark'
        var questionText = 'Are you sure you want to delete the bookmark?' +
            ' It will be moved to Trash.'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteHref)
