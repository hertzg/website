function BuildQuery (params) {
    return params.map(function (keyValue) {
        return encodeURIComponent(keyValue.key) + '=' +
            encodeURIComponent(keyValue.value)
    }).join('=')
}
