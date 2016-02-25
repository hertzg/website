<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_subscriber_locked_channel.php';
include_once '../../../lib/mysqli.php';
$values = require_subscriber_locked_channel($mysqli);
list($subscribedChannel, $id, $user) = $values;

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['notifications/subscribed-channels/view/messages']);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($subscribedChannel, $scripts)
    .Page\confirmDialog(
        'Are you sure you want to unsubscribe from the channel?',
        'Yes, unsubscribe', "submit.php?id=$id", "../view/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Unsubscribe from Other Channel #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
