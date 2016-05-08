(function () {

    var dialogShown = false

    var emptyLink = document.getElementById('empty-trash')
    emptyLink.addEventListener('click', function (e) {
        e.preventDefault()
        emptyLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, empty trash'
        var yesHref = 'empty/submit.php'
        var questionText = 'Are you sure you want to empty the trash?' +
            ' All the items in it will be purged.'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})()
