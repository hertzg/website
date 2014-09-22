<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['notifications/errors'],
    $_SESSION['notifications/messages']
);

include_once "$fnsDir/ItemList/escapedPageQuery.php";
$escapedPageQuery = ItemList\escapedPageQuery();

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
include_once '../../lib/mysqli.php';
$content =
    create_page($mysqli, $user, '../')
    .Page\confirmDialog('Are you sure you want to delete'
        .' all the notifications?', 'Yes, delete all notifications',
        'submit.php', "../$escapedPageQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Delete All Notifications?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
