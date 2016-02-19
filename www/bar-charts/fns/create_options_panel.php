<?php

function create_options_panel ($user, $base = '') {

    if (!$user->num_bar_charts) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    include_once "$fnsDir/Page/imageLink.php";
    $content = Page\imageLink('Delete All Bar Charts',
        "{$base}delete-all/".ItemList\escapedPageQuery(),
        'trash-bin', ['id' => 'delete-all']);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
