function number_format (number, decimals) {
    return number.toFixed(decimals).replace(/\d+/, function (digits) {
        var reverseDigits = digits.split('').reverse().join('')
        var result = reverseDigits.substr(0, 3)
        for (var i = 3; i < reverseDigits.length; i += 3) {
            result += ',' + reverseDigits.substr(i, 3)
        }
        return result.split('').reverse().join('')
    })
}
