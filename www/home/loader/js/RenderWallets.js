function RenderWallets (div, response) {

    var balance_total = response.user.balance_total

    var title = 'Wallets',
        href = '../wallets/',
        icon = 'wallets',
        options = { id: 'wallets' }

    if (balance_total) {
        ui.Page_thumbnailLinkWithDescription(div, title, function (span) {
            ui.Text(span, amount_text(balance_total) + ' balance.')
        }, href, icon, options)
        return
    }

    ui.Page_thumbnailLink(div, title, href, icon, options)

}
