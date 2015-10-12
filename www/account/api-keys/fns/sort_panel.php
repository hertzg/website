<?php

function sort_panel ($user) {

    if ($user->num_api_keys < 2) return;

    $order_by = $user->api_keys_order_by;
    $fnsDir = __DIR__.'/../../../fns';

    $title = 'Last accessed time';
    if ($order_by === 'access_time desc') $title .= ' (Current)';
    include_once "$fnsDir/Page/imageLink.php";
    $accessTimeLink = Page\imageLink($title,
        'submit-sort-last-accessed.php', 'sort-time');

    $title = 'Last modified time';
    if ($order_by === 'update_time desc') $title .= ' (Current)';
    $updateTimeLink = Page\imageLink($title,
        'submit-sort-last-modified.php', 'sort-time');

    $title = 'Created time';
    if ($order_by === 'insert_time desc') $title .= ' (Current)';
    $insertTimeLink = Page\imageLink($title,
        'submit-sort-created.php', 'sort-time');

    $title = 'Name';
    if ($order_by === 'name') $title .= ' (Current)';
    $nameLink = Page\imageLink($title,
        'submit-sort-name.php', 'sort-alphabetic');

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($nameLink, $updateTimeLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($insertTimeLink, $accessTimeLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Sort API Keys By', $content);

}
