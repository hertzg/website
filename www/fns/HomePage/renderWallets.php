<?php

namespace HomePage;

function renderWallets ($user, &$items) {

    $fnsDir = __DIR__.'/..';

    if ($user->show_new_wallet) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-wallet'] = \Page\imageArrowLink(
            'New Wallet', '../wallets/new/', 'create-wallet');
    }

    if ($user->show_new_transaction) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-transaction'] = \Page\imageArrowLink('New Transaction',
            '../wallets/quick-new-transaction/', 'create-transaction');
    }

    if (!$user->show_wallets) return;

    $balance_total = $user->balance_total;

    $title = 'Wallets';
    $href = '../wallets/';
    $icon = 'wallets';
    $options = ['id' => 'wallets'];

    if ($balance_total) {
        include_once "$fnsDir/amount_text.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            amount_text($balance_total).' balance.', $href, $icon, $options);
    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['wallets'] = $link;

}
