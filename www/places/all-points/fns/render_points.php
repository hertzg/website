<?php

function render_points ($points, &$items, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($points as $point) {

        $id = $point->id;
        $escapedItemQuery = ItemList\escapedItemQuery($id);

        $items[]= Page\imageArrowLink("$point->latitude $point->longitude",
            "view/$escapedItemQuery", 'point', ['id' => $id]);

    }

}
