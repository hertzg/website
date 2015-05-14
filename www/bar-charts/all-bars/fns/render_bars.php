<?php

function render_bars ($bars, &$items, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/export_date_ago.php";
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($bars as $bar) {

        $id = $bar->id;
        $title = $bar->value;
        $label = $bar->label;
        $href = "{$base}view/".ItemList\escapedItemQuery($id);
        $icon = 'bar';
        $options = ['id' => $id];

        if ($label === '') {
            $link = Page\imageArrowLink($title, $href, $icon, $options);
        } else {
            $link = Page\imageArrowLinkWithDescription($title,
                htmlspecialchars($label), $href, $icon, $options);
        }

        $items[] = $link;

    }

}
