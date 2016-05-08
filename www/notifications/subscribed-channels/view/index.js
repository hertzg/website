(function (yesHref) {

    var dialogShown = false

    var unsubscribeLink = document.getElementById('unsubscribe')
    unsubscribeLink.addEventListener('click', function (e) {
        e.preventDefault()
        unsubscribeLink.blur()
        if (dialogShown) return
        var yesText = 'Yes, unsubscribe'
        var questionText = 'Are you sure you want to' +
            ' unsubscribe from the channel?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

})(unsubscribeHref)
