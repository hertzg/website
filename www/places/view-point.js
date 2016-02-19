(function (yesHref) {

    var dialogShown = false

    var link = document.getElementById('delete')
    link.addEventListener('click', function (e) {
        e.preventDefault()
        link.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete point'
        var questionText = 'Are you sure you want to delete the point?' +
            ' The latitude, the longitude and the altitude of the place' +
            ' will be updated to the avarage of all the remaining points.'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteHref)
