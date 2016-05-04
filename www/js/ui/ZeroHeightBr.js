function ZeroHeightBr (parentNode, wrapperTagName) {
    Element(parentNode, wrapperTagName, function (wrapper) {
        wrapper.className = 'zeroHeight'
        Element(wrapper, 'br', function (br) {
            br.className = 'zeroHeight'
        })
    })
}
