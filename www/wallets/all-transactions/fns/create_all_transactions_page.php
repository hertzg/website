<?php

function create_all_transactions_page ($mysqli, $user, $wallet, $base = '') {

    $id = $wallet->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/WalletTransactions/indexOnWallet.php";
    $transactions = WalletTransactions\indexOnWallet($mysqli, $id);

    $items = [];

    include_once __DIR__.'/../../fns/render_transactions.php';
    render_transactions($transactions, $items, $base);

    unset($_SESSION['wallets/view/messages']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Transactions',
                "{$base}delete-all/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => "Wallet #$id",
                'href' => "$base../view/?id=$id#all-transactions",
            ],
        ],
        'All Transactions',
        join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteLink)
    );

}
