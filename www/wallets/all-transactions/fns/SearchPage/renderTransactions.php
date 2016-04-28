<?php

namespace SearchPage;

function renderTransactions ($transactions, &$items, $includes) {

    $fnsDir = __DIR__.'/../../../../fns';

    if ($transactions) {

        include_once "$fnsDir/keyword_regex.php";
        $regex = keyword_regex($includes);

        include_once "$fnsDir/amount_html.php";
        include_once "$fnsDir/export_date_ago.php";
        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($transactions as $transaction) {

            $description = htmlspecialchars($transaction->description);
            $description = preg_replace($regex,
                '<mark>$0</mark>', $description);
            $description = export_date_ago($transaction->insert_time, true)
                ." &middot; $description";

            $id = $transaction->id;
            $title = amount_html($transaction->amount);

            $escapedItemQuery = \ItemList\escapedItemQuery($id);

            $items[] = \Page\imageArrowLinkWithDescription($title, $description,
                "../view/$escapedItemQuery", 'transaction', ['id' => $id]);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No transactions found');
    }

}
