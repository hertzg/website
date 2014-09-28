function ForEachSourceFile (callback) {

    function scan (dir) {
        var files = fs.readdirSync(dir)
        files.forEach(function (file) {

            if (/^\./.test(file)) return

            var fullFile = dir + '/' + file

            var stat = fs.statSync(fullFile)
            if (stat.isDirectory()) scan(fullFile)
            else if (/\.(css|js|php|sh)$/.test(file) &&
                !(/^(combined|compressed)\.(css|js)$/.test(file))) {

                var content = fs.readFileSync(fullFile, 'utf8')
                var fileSubstr = fullFile.substr(rootDir.length + 1)
                if (callback(fileSubstr, content)) foundFiles.push(fileSubstr)

            }

        })
    }

    var foundFiles = []
    var rootDir = '..'
    scan(rootDir)

    foundFiles.forEach(function (file) {
        console.log(file)
    })

}

var fs = require('fs')

module.exports = ForEachSourceFile
