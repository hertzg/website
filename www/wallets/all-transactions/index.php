<?php

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

$base = '../../';
$fnsDir = '../../fns';

if (!$wallet->num_transactions) {
    include_once "$fnsDir/redirect.php";
    redirect("../view/?id=$id");
}

include_once "$fnsDir/WalletTransactions/indexOnWallet.php";
$transactions = WalletTransactions\indexOnWallet($mysqli, $id);

$items = [];

include_once '../fns/render_transactions.php';
render_transactions($transactions, $items);

unset($_SESSION['wallets/view/messages']);

include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Wallet #$id",
            'href' => "../view/?id=$id#all-transactions",
        ],
    ],
    'All Transactions',
    join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'All Transactions', $content, $base);
