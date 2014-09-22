<?php

function create_content ($items, $base) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $title = 'Delete All Files';
    $href = "{$base}delete-all/";
    $deleteAllLink =
        '<div id="deleteAllLink">'
            .Page\imageArrowLink($title, $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return Page\tabs(
        [
            [
                'title' => 'Files',
                'href' => "{$base}..",
            ],
        ],
        'Received',
        Page\sessionMessages('files/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink)
    );

}
