<?php

function create_content ($user, $total, $filterMessage, $items, $base) {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/create_options_panel.php';
    include_once __DIR__.'/create_tabs.php';
    include_once __DIR__.'/sort_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Home',
                'href' => "$base../home/#places",
                'localNavigation' => true,
            ],
            'Places',
            create_tabs($user)
            .Page\sessionErrors('places/errors')
            .Page\sessionMessages('places/messages')
            .$filterMessage.join('<div class="hr"></div>', $items),
            create_new_item_button('Place', $base, !$user->num_places)
        )
        .sort_panel($user, $total, $base)
        .create_options_panel($user, $base);

}
