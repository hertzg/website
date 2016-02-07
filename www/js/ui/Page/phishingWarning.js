function Page_phishingWarning (parentNode, absoluteBase) {
    Page_infoText(parentNode, function (div) {
        Text(div, 'You are accessing "')
        Element(div, 'code', function (code) {
            Text(code, absoluteBase)
        })
        Text(div, '". The address in your browser\'s' +
            ' address bar should start with it.')
    })
}
