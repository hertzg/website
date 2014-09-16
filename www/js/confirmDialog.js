function confirmDialog (questionText, yesText, yesHref, noListener) {

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

        var titleElement = document.createElement('div')
        titleElement.className = 'image_link-title'
        titleElement.appendChild(document.createTextNode(text))

        var contentElement = document.createElement('div')
        contentElement.className = 'image_link-content'
        contentElement.appendChild(titleElement)

        var element = document.createElement('a')
        element.className = 'clickable link image_link'
        element.appendChild(iconWrapperElement)
        element.appendChild(contentElement)

        return element

    }

    var alignerElement = document.createElement('div')
    ;(function (style) {
        style.display = 'inline-block'
        style.verticalAlign = 'middle'
        style.height = '100%'
    })(alignerElement.style)

    var textElement = document.createElement('div')
    textElement.className = 'page-text'
    textElement.appendChild(document.createTextNode(questionText))

    var yesLink = imageLink(yesText, 'yes')
    yesLink.href = yesHref

    var noLink = imageLink('No, return back', 'no')
    noLink.addEventListener('click', function () {
        body.removeChild(element)
        noListener()
    })

    var column1Element = document.createElement('div')
    column1Element.appendChild(yesLink)

    var column2Element = document.createElement('div')
    column2Element.appendChild(noLink)

    var twoColumnsElement = document.createElement('div')
    twoColumnsElement.className = 'twoColumns dynamic'
    twoColumnsElement.appendChild(column1Element)
    twoColumnsElement.appendChild(column2Element)

    var frameElement = document.createElement('div')
    ;(function (style) {
        style.display = 'inline-block'
        style.verticalAlign = 'middle'
        style.background = '#fff'
        style.whiteSpace = 'normal'
        style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.3)'
        style.textAlign = 'left'
        style.width = '100%'
        style.maxWidth = '684px'
    })(frameElement.style)
    frameElement.appendChild(textElement)
    frameElement.appendChild(hr())
    frameElement.appendChild(twoColumnsElement)

    var element = document.createElement('div')
    ;(function (style) {
        style.position = 'fixed'
        style.top = style.right = style.bottom = style.left = '0'
        style.background = 'rgba(0, 0, 0, 0.5)'
        style.whiteSpace = 'nowrap'
        style.textAlign = 'center'
        style.padding = '8px'
    })(element.style)
    element.appendChild(alignerElement)
    element.appendChild(frameElement)

    var body = document.body
    body.appendChild(element)

}
