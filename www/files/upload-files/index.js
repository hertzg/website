(function (parentId, unloadProgress) {

    function post (method, formData, loadListener) {
        var request = new XMLHttpRequest
        request.open('post', '../../api-call/' + method)
        request.send(formData)
        request.onerror = function () {
            // TODO handle error
        }
        request.onload = loadListener
        return request
    }

    var chunkSize = 1024 * 1024

    var uploading = false

    var warnings = document.querySelector('.textList.warnings')
    warnings.parentNode.removeChild(warnings)

    var uploadButton = document.getElementById('uploadButton')
    uploadButton.addEventListener('click', function (e) {

        function nextFile () {

            var file = files.shift()
            if (!file) {
                var url = 'submit-finish.php'
                if (parentId !== null) {
                    url += '?parent_id_folders=' + parentId + '&num_files=' + numFiles
                }
                location = url
                return
            }

            var name = file.name,
                size = file.size

            var reader = new FileReader
            reader.readAsArrayBuffer(file)
            reader.onabort = function () {
                // TODO handle abort
            }
            reader.onerror = function () {
                // TODO handle error
            }
            reader.onload = function () {

                function appendFile (formData, chunk) {
                    var blob = new Blob([chunk], {
                        type: 'application/octet-binary',
                    })
                    formData.append('file', blob, name)
                }

                function sliceChunk (offset, length) {
                    if (offset + length > size) length = size - offset
                    return new Uint8Array(reader.result, offset, length)
                }

                var chunk = sliceChunk(0, chunkSize)

                var formData = new FormData
                formData.append('session_auth', '1')
                formData.append('name', name)
                formData.append('auto_rename', '1')
                if (parentId !== null) formData.append('parent_id', parentId)
                appendFile(formData, chunk)

                var request = post('file/add', formData, function () {

                    function nextChunk (offset) {

                        var chunk = sliceChunk(offset, chunkSize)

                        var formData = new FormData
                        formData.append('session_auth', '1')
                        formData.append('id', id)
                        appendFile(formData, chunk)

                        post('file/appendContent', formData, function () {
                            var nextOffset = offset + chunkSize
                            if (size > nextOffset) nextChunk(nextOffset)
                            else nextFile()
                        })

                    }

                    var id = JSON.parse(request.response)
                    if (size > chunkSize) nextChunk(chunkSize)
                    else nextFile()
                })

            }

        }

        e.preventDefault()
        if (uploading) return
        uploading = true
        unloadProgress.show()

        var files = []
        var numFiles = 0
        var fileInputs = document.querySelectorAll('.form-filefield')
        Array.prototype.forEach.call(fileInputs, function (fileInput) {
            Array.prototype.forEach.call(fileInput.files, function (file) {
                files.push(file)
                numFiles++
            })
        })

        nextFile()

    })

})(parentId, unloadProgress)
