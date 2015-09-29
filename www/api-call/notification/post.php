<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notifications');

include_once '../fns/require_channel.php';
$channel = require_channel($mysqli);

if ($channel->id_users != $user->id_users) {
    include_once '../../fns/ErrorJson/badRequest.php';
    ErrorJson\badRequest('"CHANNEL_NOT_FOUND"');
}

include_once '../../fns/request_text.php';
$text = request_text('text');

if ($text === '') {
    include_once '../../fns/ErrorJson/badRequest.php';
    ErrorJson\badRequest('"ENTER_TEXT"');
}

include_once '../../fns/Users/Notifications/post.php';
Users\Notifications\post($mysqli, $channel, $text, $apiKey);

header('Content-Type: application/json');
echo 'true';
