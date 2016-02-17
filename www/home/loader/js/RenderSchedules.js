function RenderSchedules (div, response) {

    var user = response.user

    var today = user.num_schedules_today
    var tomorrow = user.num_schedules_tomorrow
    var num_new_received = user.num_received_schedules -
        user.num_archived_received_schedules

    var title = 'Schedules',
        href = '../schedules/',
        icon = 'schedules',
        options = { id: 'schedules' }

    if (today || tomorrow || num_new_received) {
        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            if (today) {
                ui.Element(span, 'span', function (span) {
                    span.className = 'colorText red'
                    ui.Text(span, today + '\xa0today.')
                })
            }
            if (num_new_received) {
                var text = num_new_received + '\xa0new\xa0received.'
                if (today || tomorrow) text = ' ' + text
                if (tomorrow) {
                    text = tomorrow + '\xa0tomorrow.' + text
                    if (today) text = '\xa0' + text
                }
                ui.Text(span, text)
            } else {
                if (tomorrow) {
                    var text = tomorrow + '\xa0tomorrow.'
                    if (today) text = ' ' + text
                    ui.Text(span, text)
                }
            }
        }, href, icon, options)
        return
    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
