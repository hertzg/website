<?php

namespace HomePage;

function renderWallets ($user, &$items) {

    if (!$user->show_wallets) return;

    $fnsDir = __DIR__.'/..';

    $num_wallets = $user->num_wallets;

    $title = 'Wallets';
    $href = '../wallets/';
    $icon = 'wallets';
    $options = ['id' => 'wallets'];

    if ($num_wallets) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $link = \Page\imageArrowLinkWithDescription($title,
            "$num_wallets total.", $href, $icon, $options);
    } else {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $link = \Page\imageArrowLink($title, $href, $icon, $options);
    }

    $items['wallets'] = $link;

}
