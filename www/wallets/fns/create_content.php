<?php

function create_content ($content, $user, $total, $base) {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/create_options_panel.php';
    include_once __DIR__.'/sort_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => "$base../home/#wallets",
                ],
            ],
            'Wallets',
            Page\sessionErrors('wallets/errors')
            .Page\sessionMessages('wallets/messages')
            .$content,
            create_new_item_button('Wallet', $base, !$user->num_wallets)
        )
        .sort_panel($user, $total, $base)
        .create_options_panel($user, $base);

}
