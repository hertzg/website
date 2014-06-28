<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

list($channel_name, $text) = request_strings('channel_name', 'text');

include_once '../../fns/str_collapse_spaces_multiline.php';
$text = str_collapse_spaces_multiline($text);
$text = trim($text);

include_once '../../fns/Channels/getByName.php';
$channel = Channels\getByName($mysqli, $channel_name);

if (!$channel || $channel->id_users != $user->id_users) {
    include_once '../fns/bad_request.php';
    bad_request('CHANNEL_NOT_FOUND');
}

if ($text === '') {
    include_once '../fns/bad_request.php';
    bad_request('ENTER_TEXT');
}

include_once '../../fns/Users/Notifications/post.php';
Users\Notifications\post($mysqli, $channel, $text);

header('Content-Type: application/json');
echo 'true';
