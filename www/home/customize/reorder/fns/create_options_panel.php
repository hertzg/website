<?php

function create_options_panel ($base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    $options = [];

    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    $options[] = Page\imageLinkWithDescription('Show / Hide Items',
        'Change the visibility of the items.', "$base../show-hide/",
        'show-hide', ['localNavigation' => true]);

    include_once "$fnsDir/Page/imageLink.php";
    $options[] =
        '<div id="restoreLink">'
            .Page\imageLink('Restore Defaults',
                "{$base}restore-defaults/", 'restore-defaults')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
