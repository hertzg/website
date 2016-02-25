<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_notifications.php';
$user = require_notifications();

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['notifications/errors'],
    $_SESSION['notifications/messages']
);

include_once '../fns/create_page.php';
include_once "$fnsDir/ItemList/escapedPageQuery.php";
include_once "$fnsDir/Page/confirmDialog.php";
include_once '../../lib/mysqli.php';
$content =
    create_page($mysqli, $user, $scripts, '../')
    .Page\confirmDialog('Are you sure you want to delete'
        .' all the notifications?', 'Yes, delete all notifications',
        'submit.php', '../'.ItemList\escapedPageQuery());

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Delete All Notifications?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
