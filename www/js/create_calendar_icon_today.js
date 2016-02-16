function create_calendar_icon_today (parentNode, response) {
    ui.Element(parentNode, 'span', function (span) {
        span.className = 'icon calendar'
        ui.Element(span, 'span', function (span) {
            span.className = 'calendarIcon-day'
            ui.Text(span, new Date(response.time).getUTCDate())
        })
    })
}
