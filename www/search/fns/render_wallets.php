<?php

function render_wallets ($wallets, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/amount_html.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($wallets as $wallet) {

        $title = htmlspecialchars($wallet->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $query = "?id=$wallet->id&amp;keyword=$encodedKeyword";
        $href = "../wallets/view/$query";

        $items[] = Page\imageArrowLinkWithDescription($title,
            amount_html($wallet->balance), $href, 'wallet');

    }

}
