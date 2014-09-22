<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
include_once '../../../lib/mysqli.php';
$content =
    create_page($mysqli, $user, '../')
    .Page\confirmDialog('Are you sure you want to delete all the events?',
        'Yes, delete all events', 'submit.php', '..');

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Delete All Events?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
