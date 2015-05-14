<?php

namespace SearchPage;

function renderTransactions ($transactions, &$items) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/amount_html.php";
    include_once "$fnsDir/export_date_ago.php";
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($transactions as $transaction) {

        $itemDescription = export_date_ago($transaction->insert_time, true);

        $description = $transaction->description;
        if ($description !== '') {
            $itemDescription .= ' &middot; '.htmlspecialchars($description);
        }

        $id = $transaction->id;
        $title = amount_html($transaction->amount);

        $escapedItemQuery = \ItemList\escapedItemQuery($id);

        $items[] = \Page\imageArrowLinkWithDescription($title, $itemDescription,
            "../view/$escapedItemQuery", 'transaction', ['id' => $id]);

    }

}
