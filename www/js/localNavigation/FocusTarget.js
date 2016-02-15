function FocusTarget () {

    var hash = location.hash
    if (hash === '') return

    var id = hash.substr(1)
    var element = document.getElementById(id)
    if (element === null) return

    element.classList.add('target')
    element.scrollIntoView()

}
