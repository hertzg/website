(function () {
function amount_text (n) {
    return (n / 100).toFixed(2).replace(/(\d+)\./, function (a, digits, decimals) {
        var reverseDigits = digits.split('').reverse().join('')
        var result = '.' + reverseDigits.substr(0, 3)
        for (var i = 3; i < reverseDigits.length; i += 3) {
            result += ',' + reverseDigits.substr(i, 3)
        }
        return result.split('').reverse().join('')
    })
}
;
function WalletOptions (response) {
    return response.wallets.map(function (wallet) {
        return {
            key: wallet.id,
            value: wallet.name + ' \xb7 ' + amount_text(wallet.balance),
        }
    })
}
;
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

                    var walletOptions = WalletOptions(response)

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
;

})()