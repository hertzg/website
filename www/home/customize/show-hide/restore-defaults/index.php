<?php

include_once '../../../../../lib/defaults.php';

$base = '../../../../';
$fnsDir = '../../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['home/customize/show-hide/messages']);

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_page($user, $head, $scripts, '../')
    .Page\confirmDialog('Are you sure you want to restore'
        .' the default visibility of the items?', 'Yes, restore defaults',
        'submit.php', '..');

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Restore Defaults?', $content, $base, [
    'head' => $head,
    'scripts' => $scripts,
]);
