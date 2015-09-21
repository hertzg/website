<?php

function sort_panel ($user, $base = '') {

    if ($user->num_schedules < 2) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $insertTimeLink = Page\imageLink('Created time',
        "{$base}submit-sort-created.php$escapedPageQuery", 'sort-time');

    $updateTimeLink = Page\imageLink('Last modified time',
        "{$base}submit-sort-last-modified.php$escapedPageQuery", 'sort-time');

    $nextTimeLink = Page\imageLink('Next day',
        "{$base}submit-sort-next-day.php$escapedPageQuery", 'sort-time');

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($nextTimeLink, $updateTimeLink)
        .'<div class="hr"></div>'
        .$insertTimeLink;

    include_once "$fnsDir/create_panel.php";
    return create_panel('Sort Schedules By', $content);

}
