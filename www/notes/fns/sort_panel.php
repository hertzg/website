<?php

function sort_panel ($user, $base = '') {

    if ($user->num_notes < 2) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $insertTimeLink = Page\imageLink('Created time',
        "{$base}submit-sort-created.php$escapedPageQuery", 'generic');

    $updateTimeLink = Page\imageLink('Last modified time',
        "{$base}submit-sort-last-modified.php$escapedPageQuery", 'generic');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content = Page\staticTwoColumns($updateTimeLink, $insertTimeLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Sort Notes By', $content);

}
