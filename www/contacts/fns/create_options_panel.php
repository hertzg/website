<?php

function create_options_panel ($user, $base = '') {

    if (!$user->num_contacts) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $href = "{$base}delete-all/".ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $content = Page\imageLink('Delete All Contacts', $href,
        'trash-bin', ['id' => 'delete-all']);

    include_once "$fnsDir/Page/panel.php";
    return Page\panel('Options', $content);

}
