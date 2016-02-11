function PublicPage (page) {
    return function (response, base, callback, options) {
        if (response.user !== undefined) {
            if (options === undefined) options = {}
            options.logoHref = base + 'home/'
        }
        page(response, base, callback, options)
    }
}
