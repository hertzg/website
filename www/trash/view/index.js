(function (yesHref) {

    var dialogShown = false

    var purgeLink = document.getElementById('purge')
    purgeLink.addEventListener('click', function (e) {
        e.preventDefault()
        purgeLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, purge item'
        var questionText = 'Are you sure you want to purge the item?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(purgeHref)
