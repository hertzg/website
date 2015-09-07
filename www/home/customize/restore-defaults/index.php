<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['home/customize/messages'],
    $_SESSION['home/customize/reorder/messages']
);

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_page('../')
    .Page\confirmDialog('Are you sure you want to restore the default home?',
        'Yes, restore defaults', 'submit.php', '..');

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Restore Defaults?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
