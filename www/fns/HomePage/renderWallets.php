<?php

namespace HomePage;

function renderWallets ($user, &$items) {

    if (!$user->show_wallets) return;

    $fnsDir = __DIR__.'/..';

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
