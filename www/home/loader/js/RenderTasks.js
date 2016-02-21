function RenderTasks (div, response) {

    var user = response.user

    var num_tasks = user.num_tasks
    var num_new_received = user.num_received_tasks -
        user.num_archived_received_tasks

    var title = 'Tasks',
        href = '../tasks/',
        icon = 'tasks',
        options = { id: 'tasks' }

    if (num_tasks || num_new_received) {

        var descriptions = []
        if (num_tasks) descriptions.push(num_tasks + '\xa0total.')
        if (num_new_received) {
            descriptions.push(num_new_received + '\xa0new\xa0received.')
        }

        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, descriptions.join(' '))
        }, href, icon, options)
        return

    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
