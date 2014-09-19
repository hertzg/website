<?php

$base = '../../../../';
$fnsDir = '../../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['home/customize/reorder/messages']);

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_page($user, '../')
    .Page\confirmDialog('Are you sure you want to restore'
        .' the default order of the items?', 'Yes, restore defaults',
        'submit.php', '..');

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Restore Defaults?', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
