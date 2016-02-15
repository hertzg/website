function UserPage (page) {
    return function (response, base, callback, options) {
        if (options === undefined) options = {}
        options.logoHref = base + 'home/'
        page(response, base, callback, options)
    }
}
