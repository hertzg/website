function RenderNotes (div, response) {

    var user = response.user

    var num_notes = user.num_notes
    var num_new_received = user.num_received_notes -
        user.num_archived_received_notes

    var title = 'Notes',
        href = '../notes/',
        icon = 'notes',
        options = { id: 'notes' }

    if (num_notes || num_new_received) {

        var descriptions = []
        if (num_notes) descriptions.push(num_notes + '\xa0total.')
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
