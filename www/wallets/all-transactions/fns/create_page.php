<?php

function create_page ($mysqli, $user, $wallet, $base = '') {

    $id = $wallet->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset("./?id=$id");

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once "$fnsDir/WalletTransactions/indexPageOnWallet.php";
    $transactions = WalletTransactions\indexPageOnWallet(
        $mysqli, $id, $offset, $limit, $total);

    $items = [];

    $params = ['id' => $id];

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/../../fns/render_transactions.php';
    render_transactions($transactions, $items, $base);

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    unset(
        $_SESSION['wallets/all-transactions/new/errors'],
        $_SESSION['wallets/all-transactions/new/values'],
        $_SESSION['wallets/view/messages']
    );

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Transactions',
                "{$base}delete-all/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
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
        .create_panel('Options', $deleteLink),
        Page\newItemButton("new/?id=$id", 'Transaction')
    );

}
