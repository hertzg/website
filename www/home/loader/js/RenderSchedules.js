function RenderSchedules (div, response) {

    var user = response.user
    var num_schedules = user.num_schedules
    var num_new_received = user.num_received_schedules -
        user.num_archived_received_schedules

    var title = 'Schedules'
    var href = '../schedules/'
    var icon = 'schedules'
    var options = { id: 'schedules' }
    if (num_schedules || num_new_received) {

        var descriptions = []
        if (num_schedules) descriptions.push(num_schedules + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }
        description = descriptions.join(' ')

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, description)
        }, href, icon, options)

    } else {
        ui.Page_thumbnailLink(div, title, href, icon, options)
    }

}
