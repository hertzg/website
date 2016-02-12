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
        .'<div id="restoreLink">'
            .Page\imageLink('Restore Defaults',
                "{$base}restore-defaults/", 'restore-defaults')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
