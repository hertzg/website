function Page_calendarTodayLink (parentNode, response, href) {
    ui.Element(parentNode, 'a', function (a) {
        a.name = 'calendar'
    })
    ui.Element(parentNode, 'a', function (a) {
        a.id = 'calendar'
        a.href = href
        a.className = 'clickable link image_link withArrow localNavigation-link'
        ui.Element(a, 'span', function (span) {
            span.className = 'image_link-icon'
            create_calendar_icon_today(span, response)
        })
        ui.Element(a, 'span', function (span) {
            span.className = 'image_link-content'
            ui.Text(span, 'Calendar')
        })
    })
}
