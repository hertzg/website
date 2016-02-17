(function (parentId, unloadProgress, sessionTimeout) {

    var chunkSize = 1024 * 1024

    var uploading = false

    var warnings = document.querySelector('.textList.warnings')
    warnings.parentNode.removeChild(warnings)

    var uploadButton = document.getElementById('uploadButton')
    uploadButton.addEventListener('click', function (e) {

        function finish () {
            var url = 'submit-finish.php?num_uploaded=' + numUploaded +
                '&num_failed=' + numLeft
            if (parentId !== null) url += '&parent_id=' + parentId
            location.assign(url)
        }

        function nextFile () {

            function appendFile (formData, chunk) {
                var blob = new Blob([new Uint8Array(chunk)], {
                    type: 'application/octet-binary',
                })
                formData.append('file', blob, name)
            }

            var file = files.shift()
            if (!file) {
                finish()
                return
            }

            var name = file.name

            var reader = ChunkedReader(file, chunkSize)
            reader.readNextChunk(function (chunk) {

                var formData = new FormData
                formData.append('session_auth', '1')
                formData.append('name', name)
                formData.append('auto_rename', '1')
                if (parentId !== null) formData.append('parent_id', parentId)
                appendFile(formData, chunk)

                var request = Post('file/add', formData, function () {

                    function nextChunk () {
                        if (reader.hasNextChunk()) {
                            reader.readNextChunk(function (chunk) {

                                var formData = new FormData
                                formData.append('session_auth', '1')
                                formData.append('id', id)
                                appendFile(formData, chunk)

                                Post('file/appendContent',
                                    formData, nextChunk, finish)

                            })
                        } else {
                            numUploaded++
                            numLeft--
                            nextFile()
                        }
                    }

                    var id = JSON.parse(request.response)
                    nextChunk()

                }, finish)

            })

        }

        e.preventDefault()
        if (uploading) return
        uploading = true
        unloadProgress.show()

        var numUploaded = 0

        var files = []
        var fileInputs = document.querySelectorAll('.form-filefield')
        Array.prototype.forEach.call(fileInputs, function (fileInput) {
            Array.prototype.forEach.call(fileInput.files, function (file) {
                files.push(file)
            })
        })

        var numLeft = files.length

        nextFile()

        setInterval(sessionTimeout.extend, 30 * 1000)

    })

})(parentId, unloadProgress, sessionTimeout)
