(function () {

    var searchButton = document.querySelector('.searchButton')

    var form = searchButton.form
    form.addEventListener('submit', function (e) {
        var keyword = keywordInput.value
        keyword = keyword.replace(/\s{2,}/g, ' ')
        keyword = keyword.replace(/^\s+/, '')
        keyword = keyword.replace(/\s+$/, '')
        keywordInput.value = keyword
        if (!keyword) {
            e.preventDefault()
            keywordInput.focus()
        }
    })

    var keywordInput = form.keyword

})()
