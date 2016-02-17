function RenderNotifications (div, response) {

    var user = response.user

    var num_notifications = user.num_notifications

    var title = 'Notifications',
        href = '../notifications/',
        options = { id: 'notifications' }

    if (num_notifications) {

        var num_new_notifications = user.num_new_notifications
        if (num_new_notifications) {
            ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
                ui.Element(span, 'span', function (span) {
                    span.className = 'colorText red'
                    ui.Text(span, num_new_notifications + '\xa0new.')
                })
                if (num_new_notifications !== num_notifications) {
                    ui.Text(span, ' ' + num_notifications + '\xa0total.')
                }
            }, href, 'notification', options)
            return
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, num_notifications + ' total.')
        }, href, 'old-notification', options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, 'old-notification', options)

}
