<?php

function create_content ($items, $base) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageLink.php";
    $href = "{$base}delete-all/";
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Files', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return Page\create(
        [
            'title' => 'Files',
            'href' => "{$base}../#received",
        ],
        'Received',
        Page\sessionErrors('files/received/errors')
        .Page\sessionMessages('files/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink)
    );

}
