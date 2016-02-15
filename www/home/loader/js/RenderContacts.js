function RenderContacts (div, response) {

    var user = response.user

    var num_contacts = user.num_contacts
    var num_new_received = user.num_received_contacts -
        user.num_archived_received_contacts

    var title = 'Contacts'
    var href = '../contacts/'
    var icon = 'contacts'
    var options = { id: 'contacts' }
    if (num_contacts || num_new_received) {

        var descriptions = []
        if (num_contacts) descriptions.push(num_contacts + '\xa0total.')
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
