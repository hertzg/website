function RenderPlaces (div, response) {

    var user = response.user

    var num_places = user.num_places
    var num_new_received = user.num_received_places -
        user.num_archived_received_places

    var title = 'Places'
    var href = '../places/'
    var icon = 'places'
    var options = { id: 'places' }
    if (num_places || num_new_received) {

        var descriptions = []
        if (num_places) descriptions.push(num_places + '\xa0total.')
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
