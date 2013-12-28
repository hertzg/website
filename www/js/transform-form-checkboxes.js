(function () {
    var formCheckboxes = document.querySelectorAll('.form-checkbox.transformable')
    Array.prototype.forEach.call(formCheckboxes, function (formCheckbox) {

        function check () {
            iconElement.classList.remove('checkbox')
            iconElement.classList.add('checked-checkbox')
        }

        function uncheck () {
            iconElement.classList.remove('checked-checkbox')
            iconElement.classList.add('checkbox')
        }

        formCheckbox.classList.remove('transformable')
        formCheckbox.style.position = 'relative'

        var hiddenElement = formCheckbox.querySelector('.hidden')
        hiddenElement.style.position = 'absolute'
        hiddenElement.style.top = hiddenElement.style.left = '0'
        hiddenElement.style.width = hiddenElement.style.height = '0'
        hiddenElement.style.overflow = 'hidden'

        var iconElement = document.createElement('div')
        iconElement.className = 'icon checkbox'
        iconElement.style.position = 'absolute'
        iconElement.style.top = iconElement.style.right = '0'
        iconElement.style.bottom = iconElement.style.left = '0'
        iconElement.style.margin = 'auto'

        var clickableElement = formCheckbox.querySelector('.clickable')
        clickableElement.appendChild(iconElement)
        clickableElement.style.position = 'relative'

        var checkboxInput = formCheckbox.querySelector('input')
        checkboxInput.addEventListener('click', function () {
            if (checkboxInput.checked) check()
            else uncheck()
        })
        checkboxInput.addEventListener('focus', function () {
            clickableElement.classList.add('focus')
        })
        checkboxInput.addEventListener('blur', function () {
            clickableElement.classList.remove('focus')
        })
        if (checkboxInput.checked) check()

    })
})()
