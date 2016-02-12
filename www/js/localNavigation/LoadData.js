function LoadData (href, search, clientRevision, loadCallback, errorCallback) {

    var loaderHref = href + 'loader/' + (search === '' ? '?' : search + '&') +
        'client_revision=' + clientRevision

    var request = new XMLHttpRequest
    request.open('get', loaderHref)
    request.send()
    request.onerror = errorCallback
    request.onload = function () {

        if (request.status !== 200) {
            errorCallback()
            return
        }

        var response
        try {
            response = JSON.parse(request.responseText)
        } catch (e) {
            errorCallback()
            return
        }

        loadCallback(response)

    }

    return {
        abort: function () {
            request.abort()
        },
    }

}
