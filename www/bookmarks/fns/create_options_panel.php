<?php

function create_options_panel ($user, $base = '') {

    if (!$user->num_bookmarks) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $href = "{$base}delete-all/".ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $content = Page\imageLink('Delete All Bookmarks',
        $href, 'trash-bin', ['id' => 'delete-all']);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
