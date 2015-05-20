<?php

include_once '../fns/require_wallets.php';
$user = require_wallets();

$base = '../../';
$fnsDir = '../../fns';

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
        'Are you sure you want to delete all the wallets?'
        .' They will be moved to Trash.',
        'Yes, delete all wallets', 'submit.php', '../');

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Delete All Wallets?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
