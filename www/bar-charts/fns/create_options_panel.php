<?php

function create_options_panel ($user, $base = '') {

    if (!$user->num_bar_charts) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    include_once "$fnsDir/Page/imageLink.php";
    $content =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Bar Charts',
                "{$base}delete-all/".ItemList\escapedPageQuery(), 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
