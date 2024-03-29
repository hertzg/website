function RenderFiles (div, response) {

    var user = response.user

    var storage_used = user.storage_used
    var num_new_received = user.num_received_files +
        user.num_received_folders - user.num_archived_received_files -
        user.num_archived_received_folders

    var title = 'Files',
        href = '../files/',
        icon = 'files',
        options = { id: 'files' }

    if (num_new_received || storage_used) {

        var descriptions = []
        if (storage_used) {
            descriptions.push(bytestr(storage_used, '\xa0') + '\xa0used.')
        }
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
