<?php

function sort_panel ($order_by, $total, $base = '') {

    if ($total < 2) return;

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    $title = 'Last accessed time';
    if ($order_by === 'access_time desc') $title .= ' (Current)';
    include_once "$fnsDir/Page/imageLink.php";
    $accessTimeLink = Page\imageLink($title,
        "{$base}submit-sort-last-accessed.php$escapedPageQuery", 'sort-time');

    $title = 'Created time';
    if ($order_by === 'insert_time desc') $title .= ' (Current)';
    $insertTimeLink = Page\imageLink($title,
        "{$base}submit-sort-created.php$escapedPageQuery", 'sort-time');

    $title = 'Username';
    if ($order_by === 'username') $title .= ' (Current)';
    $usernameLink = Page\imageLink($title,
        "{$base}submit-sort-username.php$escapedPageQuery", 'sort-alphabetic');

    $title = 'Storage used';
    if ($order_by === 'storage_used desc') $title .= ' (Current)';
    $storageUsedLink = Page\imageLink($title,
        "{$base}submit-sort-storage-used.php$escapedPageQuery", 'sort-numeric');

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($usernameLink, $storageUsedLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($insertTimeLink, $accessTimeLink);

    include_once "$fnsDir/Page/panel.php";
    return Page\panel('Sort Users By', $content);

}
