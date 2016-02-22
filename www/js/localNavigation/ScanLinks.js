function ScanLinks (absoluteBase, loaderRevisions, unloadProgress, loadHref) {
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

            var localHref = href.substr(absoluteBase.length)
            if (loaderRevisions[localHref] === undefined) return

            link.addEventListener('click', function (e) {

                if (e.button !== 0 || e.altKey ||
                    e.ctrlKey || e.metaKey || e.shiftKey) return

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
