<?php

namespace HomePage;

function renderWallets ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_wallet) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['new-wallet'] = \Page\thumbnailLink(
            'New Wallet', '../wallets/new/', 'create-wallet');
    }

    if ($user->show_new_transaction) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['new-transaction'] = \Page\thumbnailLink('New Transaction',
            '../wallets/quick-new-transaction/', 'create-transaction',
            ['localNavigation' => true]);
    }

    if ($user->show_transfer_amount) {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $items['transfer-amount'] = \Page\thumbnailLink('Transfer Amount',
            '../wallets/quick-transfer-amount/', 'transfer-amount',
            ['localNavigation' => true]);
    }

    if (!$user->show_wallets) return;

    $balance_total = $user->balance_total;

    $title = 'Wallets';
    $href = '../wallets/';
    $icon = 'wallets';
    $options = ['id' => 'wallets'];
    if ($balance_total) {
        include_once "$fnsDir/amount_text.php";
        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        $link = \Page\thumbnailLinkWithDescription($title,
            amount_text($balance_total).' balance.', $href, $icon, $options);
    } else {
        include_once "$fnsDir/Page/thumbnailLink.php";
        $link = \Page\thumbnailLink($title, $href, $icon, $options);
    }

    $items['wallets'] = $link;

}
