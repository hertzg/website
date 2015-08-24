(function () {
    var elements = document.querySelectorAll('.datefield')
    Array.prototype.forEach.call(elements, function (element) {

        function check () {

            var day = daySelect.value,
                month = monthSelect.value,
                year = yearSelect.value

            var valid = true
            if (day !== '' && month !== '' && year !== '') {

                day = parseInt(day, 10)
                month = parseInt(month, 10)
                year = parseInt(year, 10)

                var length = new Date(year, month, 0).getDate()
                valid = day <= length

            }

            if (valid) {
                dayClassList.remove('invalid')
                monthClassList.remove('invalid')
                yearClassList.remove('invalid')
            } else {
                dayClassList.add('invalid')
                monthClassList.add('invalid')
                yearClassList.add('invalid')
            }

        }

        var daySelect = element.querySelector('.form-select.day')
        daySelect.addEventListener('change', check)

        var dayClassList = daySelect.classList

        var monthSelect = element.querySelector('.form-select.month')
        monthSelect.addEventListener('change', check)

        var monthClassList = monthSelect.classList

        var yearSelect = element.querySelector('.form-select.year')
        yearSelect.addEventListener('change', check)

        var yearClassList = yearSelect.classList

        check()

    })
})()
