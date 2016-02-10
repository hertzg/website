function Form_captcha (parentNode, response, base, autofocus) {

    if (response.captchaRequired !== true) return

    if (autofocus === undefined) autofocus = false
    Element(parentNode, 'div', function (div) {
        div.className = 'form-captcha'
        Element(div, 'img', function (img) {
            img.alt = 'CAPTCHA'
            img.className = 'form-captcha-image'
            img.src = base + 'captcha/'
        })
    })
    Form_textfield(parentNode, 'captcha', 'Verification', {
        required: true,
        autofocus: autofocus,
    })
    Form_notes(parentNode, [
        'Enter the characters shown on the image above.',
        'This proves that you are a human and not a robot.',
    ])
    Hr(parentNode)

}
