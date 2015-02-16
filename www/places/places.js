(function () {

    var dialogShown = false

    var wrappers = document.querySelectorAll('.deleteLinkWrapper')
    Array.prototype.forEach.call(wrappers, function (wrapper) {


        var questionHtml =
            'Are you sure you want to remove the point from the place?'
        var yesText = 'Yes, remove point'
        var yesHref = wrapper.dataset.delete_url

        var deleteLink = wrapper.querySelector('.clickable.rightButton')
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

})()
