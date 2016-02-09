function public_page (response, base, callback, options) {
    if (response.user !== undefined) {
        if (options === undefined) options = {}
        options.logoHref = base + 'home/'
    }
    page(response, base, callback, options)
}
