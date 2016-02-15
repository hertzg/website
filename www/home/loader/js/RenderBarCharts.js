function RenderBarCharts (div, response) {

    var num_bar_charts = response.user.num_bar_charts

    var title = 'Bar Charts'
    var href = '../bar-charts/'
    var icon = 'bar-charts'
    var options = { id: 'bar-charts' }

    if (num_bar_charts > 0) {
        return ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, num_bar_charts + ' total.')
        }, href, icon, options)
    }

    return ui.Page_thumbnailLink(div, title, href, icon, options)

}
