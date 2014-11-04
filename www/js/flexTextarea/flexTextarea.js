(function () {
    var nodeList = document.querySelectorAll('.form-textarea')
    Array.prototype.forEach.call(nodeList, function (textarea) {

        function update () {
            invisibleTextarea.value = textarea.value
            invisibleTextarea.style.width = textarea.offsetWidth + 'px'
            textarea.style.height = invisibleTextarea.scrollHeight +
                textarea.offsetHeight - textarea.clientHeight + 'px'
        }

        var invisibleTextarea = document.createElement('textarea')
        invisibleTextarea.className = textarea.className
        invisibleTextarea.style.overflow = 'hidden'
        invisibleTextarea.value = textarea.value

        var wrapperElement = document.createElement('div')
        wrapperElement.style.overflow = 'hidden'
        wrapperElement.style.height = '0'
        wrapperElement.style.visibility = 'hidden'
        wrapperElement.appendChild(invisibleTextarea)

        textarea.style.resize = 'none'
        textarea.addEventListener('input', update)
        document.body.appendChild(wrapperElement)
        addEventListener('resize', update)
        update()

    })
})()
