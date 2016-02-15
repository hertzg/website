function Page_thumbnails (parentNode, callbacks) {
    Element(parentNode, 'div', function (div) {
        div.className = 'thumbnails'
        callbacks.forEach(function (callback, i) {

            if (i > 0) {
                if (i % 3 === 0) {
                    Element(div, 'span', function (span) {
                        span.className = 'hr thumbnails-br n3'
                    })
                }
                if (i % 4 === 0) {
                    Element(div, 'span', function (span) {
                        span.className = 'hr thumbnails-br n4'
                    })
                }
                if (i % 5 === 0) {
                    Element(div, 'span', function (span) {
                        span.className = 'hr thumbnails-br n5'
                    })
                }
                if (i % 6 === 0) {
                    Element(div, 'span', function (span) {
                        span.className = 'hr thumbnails-br n6'
                    })
                }
                if (i % 7 === 0) {
                    Element(div, 'span', function (span) {
                        span.className = 'hr thumbnails-br n7'
                    })
                }
            }

            var additionalClass = ''
            if (i % 3 === 1) additionalClass += ' wide_of_three'
            if (i % 6 === 1 || i % 6 === 4) additionalClass += ' narrow_of_six'

            Element(div, 'div', function (div) {
                div.className = 'thumbnails-item' + additionalClass
                callback(div)
            })

        })
    })
}
