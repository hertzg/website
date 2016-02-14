function amount_text (n) {
    return (n / 100).toFixed(2).replace(/(\d+)\./, function (a, digits, decimals) {
        var reverseDigits = digits.split('').reverse().join('')
        var result = '.' + reverseDigits.substr(0, 3)
        for (var i = 3; i < reverseDigits.length; i += 3) {
            result += ',' + reverseDigits.substr(i, 3)
        }
        return result.split('').reverse().join('')
    })
}
