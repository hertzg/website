function confirmDialog (questionHtml, yesText, yesHref, noListener) {

    function hide () {
        removeEventListener('keydown', keydownListener)
        body.removeChild(element)
        noListener()
    }

    function hr () {
        var element = document.createElement('div')
        element.className = 'hr'
        return element
    }

    function imageLink (text, iconName) {

        var iconElement = document.createElement('div')
        iconElement.className = 'icon ' + iconName

        var iconWrapperElement = document.createElement('div')
        iconWrapperElement.className = 'image_link-icon'
        iconWrapperElement.appendChild(iconElement)

        var contentElement = document.createElement('div')
        contentElement.className = 'image_link-content'
        contentElement.appendChild(document.createTextNode(text))

        var element = document.createElement('a')
        element.className = 'clickable link image_link'
        element.appendChild(iconWrapperElement)
        element.appendChild(contentElement)

        return element

    }

    function keydownListener (e) {
        if (e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) return
        if (e.keyCode == 27) {
            e.preventDefault()
            hide()
        }
    }

    var alignerElement = document.createElement('div')
    alignerElement.className = 'confirmDialog-aligner'

    var textElement = document.createElement('div')
    textElement.className = 'page-text'
    textElement.innerHTML = questionHtml

    var yesLink = imageLink(yesText, 'yes')
    yesLink.href = yesHref

    var noLink = imageLink('No, return back', 'no')
    noLink.addEventListener('click', function (e) {
        e.preventDefault()
        hide()
    })
    noLink.href = location.href

    var column1Element = document.createElement('div')
    column1Element.className = 'twoColumns-column1'
    column1Element.appendChild(yesLink)

    var column2Element = document.createElement('div')
    column2Element.className = 'twoColumns-column2'
    column2Element.appendChild(noLink)

    var twoColumnsElement = document.createElement('div')
    twoColumnsElement.className = 'twoColumns dynamic'
    twoColumnsElement.appendChild(column1Element)
    twoColumnsElement.appendChild(column2Element)

    var frameElement = document.createElement('div')
    frameElement.className = 'confirmDialog-frame'
    frameElement.appendChild(textElement)
    frameElement.appendChild(hr())
    frameElement.appendChild(twoColumnsElement)

    var element = document.createElement('div')
    element.className = 'confirmDialog'
    element.appendChild(alignerElement)
    element.appendChild(frameElement)

    var body = document.body
    body.appendChild(element)

    addEventListener('keydown', keydownListener)

}
