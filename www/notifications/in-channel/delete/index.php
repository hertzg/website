<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_notification.php';
include_once '../../../lib/mysqli.php';
list($notification, $id, $user) = require_notification($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

$id_channels = $notification->id_channels;

include_once "$fnsDir/Users/Channels/get.php";
$channel = Users\Channels\get($mysqli, $user, $id_channels);

include_once '../fns/create_page.php';
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_page($mysqli, $user, $channel, $scripts, $notifications, '../')
    .Page\confirmDialog('Are you sure you want to delete the notification?',
        'Yes, delete notification', 'submit.php'.ItemList\escapedItemQuery($id),
        '../'.ItemList\escapedItemQuery($id_channels));

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Notifications', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
