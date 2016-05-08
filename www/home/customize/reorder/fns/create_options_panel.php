<?php

function create_options_panel ($base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    $content =
        Page\imageLinkWithDescription('Show / Hide Items',
            'Change the visibility of the items.', "$base../show-hide/",
            'show-hide', ['localNavigation' => true])
        .'<div class="hr"></div>'
        .Page\imageLink('Restore Defaults', "{$base}restore-defaults/",
            'restore-defaults', ['id' => 'restore-defaults']);

    include_once "$fnsDir/Page/panel.php";
    return Page\panel('Options', $content);

}
