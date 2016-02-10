function FocusTarget () {
    var hash = location.hash
    if (hash === '') return
    var id = hash.substr(1)
    var element = document.getElementById(id)
    if (id === null) return
    element.classList.add('target')
}
