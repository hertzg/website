(function () {
    var selector = '.form-checkbox.transformable'
    var formCheckboxes = document.querySelectorAll(selector)
    Array.prototype.forEach.call(formCheckboxes, function (formCheckbox) {

        function check () {
            iconClassList.remove('checkbox')
            iconClassList.add('checked-checkbox')
        }

        function uncheck () {
            iconClassList.remove('checked-checkbox')
            iconClassList.add('checkbox')
        }

        formCheckbox.classList.remove('transformable')
        formCheckbox.style.position = 'relative'

        var inputWrapperElement = formCheckbox.querySelector('.form-checkbox-inputWrapper')
        inputWrapperElement.style.position = 'absolute'
        inputWrapperElement.style.top = inputWrapperElement.style.left = '0'
        inputWrapperElement.style.width = inputWrapperElement.style.height = '0'
        inputWrapperElement.style.overflow = 'hidden'

        var iconElement = document.createElement('div')
        iconElement.className = 'icon checkbox'
        iconElement.style.position = 'absolute'
        iconElement.style.top = iconElement.style.bottom =
            iconElement.style.left = '6px'
        iconElement.style.margin = 'auto'

        var iconClassList = iconElement.classList

        var clickableElement = formCheckbox.querySelector('.clickable')
        clickableElement.appendChild(iconElement)

        var clickableClassList = clickableElement.classList

        var checkboxInput = formCheckbox.querySelector('input')
        checkboxInput.addEventListener('click', function () {
            if (checkboxInput.checked) check()
            else uncheck()
        })
        checkboxInput.addEventListener('focus', function () {
            clickableClassList.add('focus')
        })
        checkboxInput.addEventListener('blur', function () {
            clickableClassList.remove('focus')
        })
        if (checkboxInput.checked) check()

    })
})()
