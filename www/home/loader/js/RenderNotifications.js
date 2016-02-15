function RenderNotifications (div, response) {

    var user = response.user
    var num_notifications = user.num_notifications

    var title = 'Notifications'
    var href = '../notifications/'
    var options = { id: 'notifications' }
    if (num_notifications) {
        var description
        var num_new_notifications = user.num_new_notifications
        if (num_new_notifications) {

            description =
                '<span class="colorText red">' +
                    num_new_notifications + '\xa0new.' +
                '</span>'
            if (num_new_notifications != num_notifications) {
                description += ' ' + num_notifications + '\xa0total.'
            }

            ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
                ui.Text(span, description)
            }, href, 'notification', options)

        } else {
            description = num_notifications + ' total.'
            ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
                ui.Text(span, description)
            }, href, 'old-notification', options)
        }
    } else {
        ui.Page_thumbnailLink(div, title, href, 'old-notification', options)
    }

}
