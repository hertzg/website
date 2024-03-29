<?php

function create_content ($user, $items, $base) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/Received/escapedPageQuery.php";
    $escapedPageQuery = ItemList\Received\escapedPageQuery();

    include_once "$fnsDir/Page/imageLink.php";
    $deleteAllLink = Page\imageLink('Delete All Files',
        "{$base}delete-all/$escapedPageQuery",
        'trash-bin', ['id' => 'delete-all']);

    include_once __DIR__.'/create_tabs.php';
    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Home',
                'href' => "{$base}../../home/#files",
                'localNavigation' => true,
            ],
            'Files',
            create_tabs($user)
            .Page\sessionErrors('files/received/errors')
            .Page\sessionMessages('files/received/messages')
            .join('<div class="hr"></div>', $items)
        )
        .Page\panel('Options', $deleteAllLink);

}
