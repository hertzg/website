(function (yesHref) {

    var dialogShown = false

    var link = document.getElementById('delete')
    link.addEventListener('click', function (e) {
        e.preventDefault()
        link.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete connection'
        var questionText = 'Are you sure you want to delete the connection?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteHref)
