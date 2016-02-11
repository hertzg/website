function GuestPage (page) {
    return function (response, base, callback, options) {
        page(response, base, callback, options)
    }
}
