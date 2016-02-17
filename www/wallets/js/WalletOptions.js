function WalletOptions (response) {
    return response.wallets.map(function (wallet) {
        return {
            key: wallet.id,
            value: wallet.name + ' \xb7 ' + amount_text(wallet.balance),
        }
    })
}
