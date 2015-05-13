<?php

function render_bars ($bars, &$items, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/export_date_ago.php";
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($bars as $bar) {

        $id = $bar->id;

        $escapedItemQuery = ItemList\escapedItemQuery($id);

        $items[] = Page\imageArrowLink($bar->value,
            "{$base}view/$escapedItemQuery", 'bar', ['id' => $id]);

    }

}
