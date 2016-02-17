(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        loadCallback('Transfer Amount')

        var values = response.values
        var focus = values.focus

        ui.user_page(response, '../../', function (body) {
            ui.Page_create(body, {
                title: 'Wallets',
                href: ui.ItemList_listUrl(response.itemList) + '#transfer-amount',
            }, 'Transfer Amount', function (div) {
                ui.Page_sessionErrors(div, response.errors)
                ui.Element(div, 'form', function (form) {

                    form.action = 'submit.php'
                    form.method = 'post'

                    var walletOptions = WalletOptions(response)

                    ui.Form_select(form, 'from_id_wallets', 'From', walletOptions,
                        values.from_id_wallets, focus === 'from_id_wallets')
                    ui.Hr(form)
                    ui.Form_select(form, 'to_id_wallets', 'To', walletOptions,
                        values.to_id_wallets, focus === 'to_id_wallets')
                    ui.Hr(form)
                    ui.Form_textfield(form, 'amount', 'Amount', {
                        value: values.amount,
                        required: true,
                        autofocus: focus === 'amount',
                    })
                    ui.Hr(form)
                    ui.Form_textfield(form, 'description', 'Description', {
                        value: values.description,
                        maxlength: response.maxLengths.description,
                    })
                    ui.Hr(form)
                    ui.Form_button(form, 'Save Transaction')
                    ui.ItemList_pageHiddenInputs(form, response.itemList)

                })
            })
        })

        localNavigation.scanLinks()
        localNavigation.focusTarget()

    }

    localNavigation.registerPage('wallets/quick-transfer-amount/', loader)

})(localNavigation, ui)