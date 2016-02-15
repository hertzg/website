function RenderBookmarks (div, response) {

    var user = response.user

    var num_bookmarks = user.num_bookmarks
    var num_new_received = user.num_received_bookmarks -
        user.num_archived_received_bookmarks

    var title = 'Bookmarks'
    var href = '../bookmarks/'
    var icon = 'bookmarks'
    var options = { id: 'bookmarks' }
    if (num_bookmarks || num_new_received) {

        var descriptions = []
        if (num_bookmarks) descriptions.push(num_bookmarks + '\xa0total.')
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
