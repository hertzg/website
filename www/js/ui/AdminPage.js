function AdminPage (page) {
    return function (response, adminBase, callback, options) {

        if (options === undefined) options = {}

        options.logoHref = adminBase
        if (response.user !== undefined) {
            options.logoHref += '../home/'
            options.localNavigation = true
        }

        page(response, adminBase + '../', callback, options)

    }
}
