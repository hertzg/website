function public_page (body, user, base, options) {
    if (user) {
        if (options === undefined) options = {}
        options.logoHref = base + 'home/'
    }
    page(body, user, base, options)
}
