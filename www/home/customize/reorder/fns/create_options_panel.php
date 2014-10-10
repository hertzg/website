<?php

function create_options_panel ($base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    $options = [];

    $title = 'Show / Hide Items';
    $description = 'Change the visibility of the items.';
    $href = "$base../show-hide/";
    $icon = 'show-hide';
    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    $options[] = Page\imageLinkWithDescription($title,
        $description, $href, $icon);

    $href = "{$base}restore-defaults/";
    include_once "$fnsDir/Page/imageLink.php";
    $options[] =
        '<div id="restoreLink">'
            .Page\imageLink('Restore Defaults', $href, 'restore-defaults')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
