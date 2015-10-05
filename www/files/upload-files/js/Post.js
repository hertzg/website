function Post (method, formData, loadListener, errorListener) {
    var request = new XMLHttpRequest
    request.open('post', '../../api-call/' + method)
    request.send(formData)
    request.onerror = errorListener
    request.onload = function () {
        if (request.status == 200) loadListener()
        else errorListener()
    }
    return request
}
