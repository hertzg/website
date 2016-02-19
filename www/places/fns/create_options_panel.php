<?php

function create_options_panel ($user, $base = '') {

    if (!$user->num_places) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    include_once "$fnsDir/Page/imageLink.php";
    $content =
        Page\imageArrowLink('Map',
            "{$base}map/".ItemList\listHref(''), 'place-on-earth')
        .'<div class="hr"></div>'
        .Page\imageLink('Delete All Places',
            "{$base}delete-all/".ItemList\escapedPageQuery(),
            'trash-bin', ['id' => 'delete-all']);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
