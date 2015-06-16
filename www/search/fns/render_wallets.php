<?php

function render_wallets ($wallets, $total,
    $groupLimit, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';

    $num_wallets = count($wallets);
    if ($total > $groupLimit) array_pop($wallets);

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

    if ($num_wallets < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("All $total Wallets",
            "../wallets/search/?keyword=$encodedKeyword", 'wallets');
    }

}
