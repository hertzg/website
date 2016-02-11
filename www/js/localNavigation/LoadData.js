function LoadData (href, clientRevision, loadCallback, errorCallback) {

    var request = new XMLHttpRequest
    request.open('get', href + 'loader/?client_revision=' + clientRevision)
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
