<?php

function create_content ($items) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $title = 'Delete All Files';
    $deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return Page\tabs(
        [
            [
                'title' => 'Files',
                'href' => '..',
            ],
        ],
        'Received',
        Page\sessionMessages('files/received/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteAllLink)
    );

}
