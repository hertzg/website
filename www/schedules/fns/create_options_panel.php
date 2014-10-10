<?php

function create_options_panel ($user, $base = '') {

    if (!$user->num_schedules) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    $href = "{$base}delete-all/$escapedPageQuery";
    include_once "$fnsDir/Page/imageLink.php";
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Schedules', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $deleteAllLink);

}
