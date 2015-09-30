<?php

function sort_panel ($order_by) {

    $fnsDir = __DIR__.'/../../../fns';

    $title = 'Last accessed time';
    if ($order_by === 'last_access_time desc') $title .= ' (Current)';
    include_once "$fnsDir/Page/imageLink.php";
    $lastAccessedTimeLink = Page\imageLink($title,
        'submit-sort-last-accessed.php', 'sort-time');

    $title = 'Created time';
    if ($order_by === 'insert_time desc') $title .= ' (Current)';
    $insertTimeLink = Page\imageLink($title,
        'submit-sort-created.php', 'sort-time');

    $title = 'Username';
    if ($order_by === 'username') $title .= ' (Current)';
    $usernameLink = Page\imageLink($title,
        'submit-sort-username.php', 'sort-alphabetic');

    $title = 'Storage used';
    if ($order_by === 'storage_used desc') $title .= ' (Current)';
    $storageUsedLink = Page\imageLink($title,
        'submit-sort-storage-used.php', 'sort-numeric');

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($usernameLink, $storageUsedLink)
        .'<div class="ht"></div>'
        .Page\twoColumns($insertTimeLink, $lastAccessedTimeLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Sort Users By', $content);

}
