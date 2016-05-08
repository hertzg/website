(function (yesHref) {

    var dialogShown = false

    var deletePhotoLink = document.getElementById('delete-photo')
    deletePhotoLink.addEventListener('click', function (e) {
        e.preventDefault()
        deletePhotoLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete photo'
        var questionText =
            'Are you sure you want to delete the photo of the contact?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deletePhotoHref)
