function public_page (body, response, base, options) {
    if (response.user !== undefined) {
        if (options === undefined) options = {}
        options.logoHref = base + 'home/'
    }
    page(body, response, base, options)
}
