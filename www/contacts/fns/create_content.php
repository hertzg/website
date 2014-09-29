<?php

function create_content ($user, $filterMessage, $items, $base, $searchForm) {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/../fns/create_options_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    $content =
        Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../home/',
                ],
            ],
            'Contacts',
            Page\sessionErrors('contacts/errors')
            .Page\sessionMessages('contacts/messages')
            .$filterMessage.join('<div class="hr"></div>', $items),
            create_new_item_button('Contact', $base)
        )
        .create_options_panel($user, $base);

    if ($searchForm) {
        include_once "$fnsDir/compressed_js_script.php";
        $content .= compressed_js_script('searchForm', "$base../");
    }

    return $content;

}
