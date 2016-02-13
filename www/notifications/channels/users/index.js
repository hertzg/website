(function (channelName) {

    var escapeHtml = (function () {
        var element = document.createElement('div')
        return function (plain) {
            element.appendChild(document.createTextNode(plain))
            var escaped = element.innerHTML
            element.removeChild(element.firstChild)
            return escaped
        }
    })()

    var escapedChannelName = escapeHtml(channelName)

    var dialogShown = false

    var wrappers = document.querySelectorAll('.deleteLinkWrapper')
    Array.prototype.forEach.call(wrappers, function (wrapper) {

        var dataset = wrapper.dataset

        var questionHtml =
            'Are you sure you want to remove the user "<b>' +
            escapeHtml(dataset.username) +
            '</b>" from the channel "<b>' +
            escapedChannelName +
            '</b>"?'
        var yesText = 'Yes, remove user'
        var yesHref = 'delete/submit.php?id=' + dataset.id

        var deleteLink = wrapper.querySelector('.clickable.removableItem-removeButton')
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

})(channelName)
