<?php

function create_content ($items, $optionsPanel, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    // TODO make new item button green
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return Page\create(
        [
            'title' => 'Administration',
            'href' => "$base../#invitations",
        ],
        'Invitations',
        Page\sessionErrors('admin/invitations/errors')
        .Page\sessionMessages('admin/invitations/messages')
        .join('<div class="hr"></div>', $items)
        .$optionsPanel,
        Page\newItemButton("{$base}new/", 'Invitation')
    );

}
