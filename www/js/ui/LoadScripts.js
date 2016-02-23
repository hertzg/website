function LoadScripts (scripts, callback) {

    function next () {
        if (scripts.length === 0) {
            current = null
            callback()
            return
        }
        var src = scripts.shift()
        current = LoadScript(src, next, next)
    }

    var current = null

    next()

    return {
        abort: function () {
            current.abort()
            current = null
        },
    }

}
