function RenderBarCharts (div, response) {

    var num_bar_charts = response.user.num_bar_charts

    var title = 'Bar Charts',
        href = '../bar-charts/',
        icon = 'bar-charts',
        options = { id: 'bar-charts' }

    if (num_bar_charts) {
        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, num_bar_charts + ' total.')
        }, href, icon, options)
        return
    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
