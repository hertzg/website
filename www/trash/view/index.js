(function (deleteHref) {

    var dialogShown = false

    var purgeLink = document.getElementById('purgeLink').firstChild
    purgeLink.addEventListener('click', function (e) {
        e.preventDefault()
        purgeLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, purge item'
        var questionText = 'Are you sure you want to purge the item?'
        confirmDialog(questionText, yesText, deleteHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(deleteHref)
