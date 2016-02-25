<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/require_subscribed_channel.php';
include_once '../../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

$base = '../../../../';
$fnsDir = '../../../../fns';

unset($_SESSION['notifications/channels/users/messages']);

$id_channels = $subscribedChannel->id_channels;
$escaped_subscriber_username = htmlspecialchars(
    $subscribedChannel->subscriber_username);

include_once "$fnsDir/Page/confirmDialog.php";
include_once '../fns/create_page.php';
$content =
    create_page($mysqli, $id_channels, '../')
    .Page\confirmDialog('Are you sure you want to remove the user "<b>'
        .$escaped_subscriber_username
        .'</b>" from the channel "<b>'
        .htmlspecialchars($subscribedChannel->channel_name)
        .'</b>"?', 'Yes, remove user', "submit.php?id=$id",
        "../?id=$id_channels");

$title = "Remove User \"$escaped_subscriber_username\""
    ." from Channel #$id_channels?";

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, $title, $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
