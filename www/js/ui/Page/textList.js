function Page_textList (parentNode, texts, className) {
    Element(parentNode, 'div', function (div) {
        div.className = 'textList ' + className
        Element(div, 'ul', function (ul) {
            ul.className = 'textList-list'
            if (texts.length === 1) {
                Element(ul, 'li', function (li) {
                    li.className = 'textList-list-item'
                    li.innerHTML = texts[0]
                })
            } else {
                texts.forEach(function (text) {
                    Element(ul, 'li', function (li) {
                        li.className = 'textList-list-item'
                        Element(li, 'span', function (span) {
                            span.className = 'textList-list-item-bullet ' + className
                        })
                        li.innerHTML += text
                    })
                })
            }
        })
    })
}
