<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_one_channel.php';
include_once '../../lib/mysqli.php';
$user = require_one_channel($mysqli);

include_once "$fnsDir/request_strings.php";
list($id_channels) = request_strings('id_channels');

$id_channels = abs((int)$id_channels);

include_once "$fnsDir/request_text.php";
$text = request_text('text');

$errors = [];
$focus = null;

include_once "$fnsDir/Users/Channels/get.php";
$channel = Users\Channels\get($mysqli, $user, $id_channels);

if (!$channel) {
    $errors[] = 'The channel no longer exists.';
    $focus = 'id_channels';
}

if ($text === '') {
    $errors[] = 'Enter text.';
    if ($focus === null) $focus = 'text';
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notifications/post/errors'] = $errors;
    $_SESSION['notifications/post/values'] = [
        'focus' => $focus,
        'id_channels' => $id_channels,
        'text' => $text,
    ];
    redirect();
}

unset(
    $_SESSION['notifications/post/errors'],
    $_SESSION['notifications/post/values']
);

include_once "$fnsDir/Users/Notifications/post.php";
Users\Notifications\post($mysqli, $channel, $text);

$_SESSION['notifications/messages'] = ['Notification has been posted.'];
unset($_SESSION['notifications/errors']);

redirect('..');
