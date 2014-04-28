<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

list($channel_name, $notification_text) = request_strings(
    'channel_name', 'notification_text');

include_once '../../fns/str_collapse_spaces_multiline.php';
$notification_text = str_collapse_spaces_multiline($notification_text);
$notification_text = trim($notification_text);

include_once '../../fns/Channels/getByName.php';
$channel = Channels\getByName($mysqli, $channel_name);

if (!$channel || $channel->id_users != $user->id_users) {
    include_once '../fns/bad_request.php';
    bad_request('CHANNEL_NOT_FOUND');
}

if ($notification_text === '') {
    include_once '../fns/bad_request.php';
    bad_request('ENTER_NOTIFICATION_TEXT');
}

include_once '../../fns/send_notification.php';
send_notification($mysqli, $channel, $notification_text);

echo json_encode(true);
