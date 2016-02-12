function ItemList_pageHiddenInputs (parentNode, itemList, params) {

    if (params === undefined) params = []

    itemList.concat(params).forEach(function (keyValue) {
        Form_hidden(parentNode, keyValue.key, keyValue.value)
    })

}
