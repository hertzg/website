<?php

function sort_panel ($user, $total, $base = '') {

    if ($total < 2) return;

    $order_by = $user->calculations_order_by;
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    $title = 'Created time';
    if ($order_by === 'insert_time desc') $title .= ' (Current)';
    include_once "$fnsDir/Page/imageLink.php";
    $insertTimeLink = Page\imageLink($title,
        "{$base}submit-sort-created.php$escapedPageQuery", 'sort-time');

    $title = 'Last modified time';
    if ($order_by === 'update_time desc') $title .= ' (Current)';
    $updateTimeLink = Page\imageLink($title,
        "{$base}submit-sort-last-modified.php$escapedPageQuery", 'sort-time');

    $title = 'Title';
    if ($order_by === 'title, insert_time desc') $title .= ' (Current)';
    $titleLink = Page\imageLink($title,
        "{$base}submit-sort-title.php$escapedPageQuery", 'sort-alphabetic');

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($titleLink, $updateTimeLink)
        .'<div class="hr"></div>'
        . $insertTimeLink;

    include_once "$fnsDir/Page/panel.php";
    return Page\panel('Sort Calculations By', $content);

}
