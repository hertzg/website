<?php

function render_bars ($bars, &$items) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/export_date_ago.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($bars as $bar) {
        $id = $bar->id;
        $items[] = Page\imageArrowLink($bar->value,
            "../view-bar/?id=$id", 'bar', ['id' => $id]);
    }

}
