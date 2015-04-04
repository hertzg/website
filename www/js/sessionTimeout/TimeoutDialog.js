function TimeoutDialog (noHref, yesListener, noListener) {

    function hide () {
        removeEventListener('keydown', keydownListener)
        body.removeChild(element)
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

    function keydownListener (e) {
        if (e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) return
        if (e.keyCode == 27) {
            e.preventDefault()
            noListener()
        }
    }

    var alignerElement = document.createElement('div')
    alignerElement.className = 'confirmDialog-aligner'

    var seconds = 60

    var questionText = 'Your session is about to expire.' +
        ' Whould you like to extend your session?' +
        ' It will automatically sign out in ' + seconds + ' seconds.'

    var textElement = document.createElement('div')
    textElement.className = 'page-text'
    textElement.appendChild(document.createTextNode(questionText))

    var yesLink = imageLink('Yes, extend session', 'yes')
    yesLink.href = location.href
    yesLink.addEventListener('click', function (e) {
        e.preventDefault()
        hide()
        clearTimeout(timeout)
        yesListener()
    })

    var noLink = imageLink('No, sign out', 'no')
    noLink.href = noHref
    noLink.addEventListener('click', function (e) {
        e.preventDefault()
        noListener()
    })

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

    var timeout = setTimeout(noListener, seconds * 1000)

    return { hide: hide }

}
