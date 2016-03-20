<?php

function sort_panel ($user, $total, $base = '') {

    if ($total < 2) return;

    $order_by = $user->notes_order_by;
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

    include_once "$fnsDir/Page/twoColumns.php";
    $content = Page\twoColumns($updateTimeLink, $insertTimeLink);

    include_once "$fnsDir/Page/panel.php";
    return Page\panel('Sort Notes By', $content);

}
