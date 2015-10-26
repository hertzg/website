<?php

function create_content ($content, $user, $total, $base, $searchForm) {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/create_options_panel.php';
    include_once __DIR__.'/sort_panel.php';
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
        .sort_panel($user, $total, $base)
        .create_options_panel($user, $base),
        create_new_item_button('Wallet', $base)
    );

    if ($searchForm) {
        include_once "$fnsDir/compressed_js_script.php";
        $content .= compressed_js_script('searchForm', "$base../");
    }

    return $content;

}
