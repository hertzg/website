function RenderCalendar (div, response) {

    function n_events (n) {
        if (n == 1) return '1\xa0event'
        return n + '\xa0events'
    }

    var user = response.user

    var today = user.num_events_today +
        user.num_task_deadlines_today + user.num_birthdays_today

    var tomorrow = user.num_events_tomorrow +
        user.num_task_deadlines_tomorrow + user.num_birthdays_tomorrow

    ui.Element(div, 'a', function (a) {
        a.name = 'calendar'
    })
    ui.Element(div, 'a', function (a) {
        a.href = '../calendar/'
        a.id = 'calendar'
        a.className = 'clickable link thumbnail_link'
        ui.Element(a, 'span', function (span) {
            span.className = 'thumbnail_link-icon'
            create_calendar_icon_today(span, response)
        })
        ui.Element(a, 'span', function (span) {
            span.className = 'thumbnail_link-content'
            ui.Element(span, 'span', function (span) {
                span.className = 'thumbnail_link-title'
                ui.Text(span, 'Calendar')
            })
            if (today || tomorrow) {
                ui.ZeroHeightBr(span)
                ui.Element(span, 'span', function (span) {

                    span.className = 'thumbnail_link-description colorText grey'

                    if (today) {
                        ui.Element(span, 'span', function (span) {
                            span.className = 'colorText red'
                            ui.Text(span, n_events(today) + '\xa0today.')
                        })
                    }

                    if (tomorrow) {
                        var text = n_events(tomorrow) + '\xa0tomorrow.'
                        if (today) text = ' ' + text
                        ui.Text(span, text)
                    }

                })
            }
        })
    })

}
