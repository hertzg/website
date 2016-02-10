function export_date_ago (parentNode, timeNow, time, uppercase) {
    Element(parentNode, 'span', function (span) {
        span.className = 'dateAgo'
        span.dataset.time = time
        if (uppercase === true) span.dataset.uppercase = '1'
        Text(span, DateAgo(time * 1000, timeNow, uppercase))
    })
}
