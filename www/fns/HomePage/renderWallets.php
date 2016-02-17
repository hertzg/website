<?php

namespace HomePage;

function renderWallets ($user) {

    $fnsDir = __DIR__.'/..';
    $balance_total = $user->balance_total;

    $title = 'Wallets';
    $href = '../wallets/';
    $icon = 'wallets';
    $options = ['id' => 'wallets'];

    if ($balance_total) {
        include_once "$fnsDir/amount_text.php";
        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return \Page\thumbnailLinkWithDescription($title,
            amount_text($balance_total).' balance.', $href, $icon, $options);
    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return \Page\thumbnailLink($title, $href, $icon, $options);

}
