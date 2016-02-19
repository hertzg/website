(function (yesHref) {

    var dialogShown = false

    var link = document.getElementById('delete-all')
    link.addEventListener('click', function (e) {
        e.preventDefault()
        link.blur()
        if (dialogShown) return
        var yesText = 'Yes, delete notifications'
        var questionText = 'Are you sure you want to delete' +
            ' notifications in this channel?'
        confirmDialog(questionText, yesText, yesHref, function () {
            dialogShown = false
        })
        dialogShown = true
    })

    var wrappers = document.querySelectorAll('.deleteLinkWrapper')
    Array.prototype.forEach.call(wrappers, function (wrapper) {

        var questionHtml = 'Are you sure you want to delete the notification?'
        var yesText = 'Yes, delete notification'
        var yesHref = wrapper.dataset.delete_href

        var deleteLink = wrapper.querySelector('.removableItem-removeButton')
        deleteLink.addEventListener('click', function (e) {
            e.preventDefault()
            deleteLink.blur()
            if (dialogShown) return
            dialogShown = true
            confirmDialog(questionHtml, yesText, yesHref, function () {
                dialogShown = false
            })
        })

    })

})(deleteAllHref)
