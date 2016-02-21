function RenderPlaces (div, response) {

    var user = response.user

    var num_places = user.num_places
    var num_new_received = user.num_received_places -
        user.num_archived_received_places

    var title = 'Places',
        href = '../places/',
        icon = 'places',
        options = { id: 'places' }

    if (num_places || num_new_received) {

        var descriptions = []
        if (num_places) descriptions.push(num_places + '\xa0total.')
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
