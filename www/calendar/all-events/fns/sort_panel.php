<?php

function sort_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $insertTimeLink = Page\imageLink('Created time',
        "{$base}submit-sort-created.php$escapedPageQuery", 'sort-time');

    $updateTimeLink = Page\imageLink('Last modified time',
        "{$base}submit-sort-last-modified.php$escapedPageQuery", 'sort-time');

    $eventTimeLink = Page\imageLink('Event time',
        "{$base}submit-sort-when.php$escapedPageQuery", 'sort-time');

    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($eventTimeLink, $updateTimeLink)
        .'<div class="hr"></div>'
        .$insertTimeLink;

    include_once "$fnsDir/create_panel.php";
    return create_panel('Sort Events By', $content);

}
