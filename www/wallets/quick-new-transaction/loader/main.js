(function (localNavigation, ui) {

    function loader (response, loadCallback) {

        loadCallback('New Transaction')

        var values = response.values
        var focus = values.focus

        ui.user_page(response, '../../', function (body) {
            ui.Page_create(body, {
                title: 'Wallets',
                href: ui.ItemList_listUrl(response.itemList) + '#new-transaction',
            }, 'New Transaction', function (div) {
                ui.Page_sessionErrors(div, response.errors)
                ui.Element(div, 'form', function (form) {

                    form.action = 'submit.php'
                    form.method = 'post'

                    var walletOptions = []
                    response.wallets.forEach(function (wallet) {
                        walletOptions.push({
                            key: wallet.id,
                            value: wallet.name + ' \xb7 ' + amount_text(wallet.balance),
                        })
                    })

                    ui.Form_select(form, 'id_wallets', 'Wallet', walletOptions,
                        values.id_wallets, focus === 'id_wallets')
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

    localNavigation.registerPage('wallets/quick-new-transaction/', loader)

})(localNavigation, ui)
