function AbsoluteBase (base) {
    var a = document.createElement('a')
    a.href = base
    console.log('AbsoluteBase', base, a.href)
    return a.href
}
