<?php

namespace SearchPage;

function renderWallets ($wallets, &$items, $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($wallets) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/amount_html.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($wallets as $wallet) {

            $id = $wallet->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );

            $name = $wallet->name;
            $escapedName = htmlspecialchars($name);
            $title = preg_replace($regex, '<mark>$0</mark>', $escapedName);

            $items[] = \Page\imageArrowLinkWithDescription(
                $title, amount_html($wallet->balance),
                "../view/?$queryString",'wallet');

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No wallets found');
    }

}