(function () {

    var dialogShown = false

    var link = document.getElementById('delete-all')
    link.addEventListener('click', function (e) {
        e.preventDefault()
        link.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete all notes'
        var yesHref = 'delete-all/submit.php'
        var questionText = 'Are you sure you want to delete' +
            ' all the received notes? They will be moved to Trash.'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})()
