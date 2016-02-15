function RenderNotes (div, response) {

    var user = response.user

    var num_notes = user.num_notes
    var num_new_received = user.num_received_notes -
        user.num_archived_received_notes

    var title = 'Notes'
    var href = '../notes/'
    var icon = 'notes'
    var options = { id: 'notes' }
    if (num_notes || num_new_received) {

        var descriptions = []
        if (num_notes) descriptions.push(num_notes + '\xa0total.')
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
