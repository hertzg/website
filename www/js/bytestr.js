function bytestr (bytes, space) {

    if (space === undefined) space = ' '

    var names = ['B', 'KB', 'MB', 'GB', 'TB']
    for (var i = 0; i < names.length; i++) {
        if (bytes >= 1024) bytes /= 1024
        else {
            var decimals
            if (Math.round(bytes * 10) % 10) decimals = 1
            else decimals = 0
            return number_format(bytes, decimals) + space + names[i]
        }
    }

}
