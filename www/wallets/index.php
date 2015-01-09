<?php

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/Page/info.php";
$content = Page\info('No wallets');

include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../home/#wallets',
        ],
    ],
    'Wallets',
    $content,
    create_new_item_button('Wallet')
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Wallets', $content, $base);
