<?php

function sort_panel ($user, $base = '') {

    if ($user->num_wallets < 2) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $insertTimeLink = Page\imageLink('Created time',
        "{$base}submit-sort-created.php$escapedPageQuery", 'sort-time');

    $updateTimeLink = Page\imageLink('Last modified time',
        "{$base}submit-sort-last-modified.php$escapedPageQuery", 'sort-time');

    $nameLink = Page\imageLink('Name',
        "{$base}submit-sort-name.php$escapedPageQuery", 'sort-alphabetic');

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($nameLink, $updateTimeLink)
        .'<div class="hr"></div>'
        .$insertTimeLink;

    include_once "$fnsDir/create_panel.php";
    return create_panel('Sort Wallets By', $content);

}
