(function (yesHref) {

    var dialogShown = false

    var link = document.getElementById('delete')
    link.addEventListener('click', function (e) {
        e.preventDefault()
        link.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete remembered session'
        var questionText =
            'Are you sure you want to delete the remembered session?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteHref)
