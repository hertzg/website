<?php

function create_options_panel ($user, $base = '') {

    if (!$user->num_schedules) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    $title = 'Delete All Schedules';
    $href = "{$base}delete-all/$escapedPageQuery";
    include_once "$fnsDir/Page/imageArrowLink.php";
    $deleteAllLink = Page\imageArrowLink($title, $href, 'trash-bin');

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $deleteAllLink);

}
