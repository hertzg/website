function ScanLinks (unloadProgress, loadHref) {
    return function () {
        var links = document.querySelectorAll('.localNavigation-link')
        Array.prototype.forEach.call(links, function (link) {

            var href = link.href

            var hash = href.match(/(?:#.*)?$/)[0]
            if (hash !== '') {
                href = href.substr(0, href.length - hash.length)
            }

            var search = href.match(/(?:\?.*)?$/)[0]
            if (search !== '') {
                href = href.substr(0, href.length - search.length)
            }

            link.addEventListener('click', function (e) {

                e.preventDefault()
                unloadProgress.show()

                loadHref(href, search, hash, function () {
                    history.pushState({
                        href: href,
                        search: search,
                        hash: hash,
                    }, document.title, href + search + hash)
                })

            })

        })
    }
}
