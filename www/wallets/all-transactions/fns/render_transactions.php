<?php

function render_transactions ($transactions, &$items, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/amount_html.php";
    include_once "$fnsDir/date_ago.php";
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($transactions as $transaction) {

        $itemDescription = ucfirst(date_ago($transaction->insert_time));

        $description = $transaction->description;
        if ($description !== '') {
            $itemDescription .= ' &middot; '.htmlspecialchars($description);
        }

        $id = $transaction->id;
        $title = amount_html($transaction->amount);

        $escapedItemQuery = ItemList\escapedItemQuery($id);

        $items[] = Page\imageArrowLinkWithDescription($title, $itemDescription,
            "{$base}view/$escapedItemQuery", 'transaction', ['id' => $id]);

    }

}
