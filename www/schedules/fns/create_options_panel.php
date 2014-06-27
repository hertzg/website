<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "{$base}new/$escapedPageQuery";
    $options = [Page\imageArrowLink('New Schedule', $href, 'create-schedule')];

    if ($user->num_schedules) {
        $title = 'Delete All Schedules';
        $href = "{$base}delete-all/$escapedPageQuery";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
