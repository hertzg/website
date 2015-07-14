function ChunkedReader (file, chunkSize) {
    var offset = 0
    return {
        hasNextChunk: function () {
            return offset < file.size
        },
        readNextChunk: function (callback) {
            var blob = file.slice(offset, offset + chunkSize)
            var reader = new FileReader
            reader.readAsArrayBuffer(blob)
            reader.onload = function () {
                offset += chunkSize
                callback(reader.result)
            }
        },
    }
}
