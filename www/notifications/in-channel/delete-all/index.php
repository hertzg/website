<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_channel_notifications.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel_notifications($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['notifications/in-channel/messages']);

include_once '../fns/create_page.php';
$content = create_page($mysqli, $user,
    $channel, $scripts, $notifications, '../');

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once "$fnsDir/Page/confirmDialog.php";
$content .= Page\confirmDialog(
    'Are you sure you want to delete notifications in this channel?',
    'Yes, delete notifications', "submit.php?id=$id", "../$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Delete Notifications?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
