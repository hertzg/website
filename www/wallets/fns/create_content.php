<?php

function create_content ($content, $user, $base, $searchForm) {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/create_options_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    $content = Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => "$base../home/#wallets",
            ],
        ],
        'Wallets',
        Page\sessionErrors('wallets/errors')
        .Page\sessionMessages('wallets/messages')
        .$content
        .create_options_panel($user),
        create_new_item_button('Wallet', $base)
    );

    if ($searchForm) {
        include_once "$fnsDir/compressed_js_script.php";
        $content .= compressed_js_script('searchForm', "$base../");
    }

    return $content;

}
