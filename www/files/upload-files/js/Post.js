function Post (method, formData, loadListener) {
    var request = new XMLHttpRequest
    request.open('post', '../../api-call/' + method)
    request.send(formData)
    request.onerror = function () {
        // TODO handle error
    }
    request.onload = loadListener
    return request
}
