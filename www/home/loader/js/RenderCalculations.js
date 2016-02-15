function RenderCalculations (div, response) {

    var user = response.user

    var num_calculations = user.num_calculations
    var num_new_received = user.num_received_calculations -
        user.num_archived_received_calculations

    var title = 'Calculations'
    var href = '../calculations/'
    var icon = 'calculations'
    var options = { id: 'calculations' }
    if (num_calculations || num_new_received) {

        var descriptions = []
        if (num_calculations) descriptions.push(num_calculations + '\xa0total.')
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
