function ItemList_listUrl (itemList, base, params) {

    if (base === undefined) base = '../'
    if (params === undefined) params = []

    var href = base

    var keyword = itemList.keyword
    if (keyword !== undefined) {
        href += 'search/'
        params.push({
            key: 'keyword',
            value: keyword,
        })
    }

    var tag = itemList.tag
    if (tag !== undefined) {
        params.push({
            key: 'tag',
            value: tag,
        })
    }

    var offset = itemList.offset
    if (offset !== undefined) {
        params.push({
            key: 'offset',
            value: offset,
        })
    }

    if (params.length) href += '?' + BuildQuery(params)

    return href

}
