<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['wallets/errors'],
    $_SESSION['wallets/messages']
);

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
include_once '../../lib/mysqli.php';
$content =
    create_page($mysqli, $user, '../')
    .Page\confirmDialog(
        'Are you sure you want to delete all the wallets?',
        'Yes, delete all wallets', 'submit.php', '../');

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Wallets', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
