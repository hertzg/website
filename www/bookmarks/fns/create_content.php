<?php

function create_content ($user, $total, $filterMessage, $items, $base) {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/create_options_panel.php';
    include_once __DIR__.'/sort_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Home',
                'href' => "$base../home/#bookmarks",
            ],
            'Bookmarks',
            Page\sessionErrors('bookmarks/errors')
            .Page\sessionMessages('bookmarks/messages')
            .$filterMessage.join('<div class="hr"></div>', $items),
            create_new_item_button('Bookmark', $base, !$user->num_bookmarks)
        )
        .sort_panel($user, $total, $base)
        .create_options_panel($user, $base);

}
