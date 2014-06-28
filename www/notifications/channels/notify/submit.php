<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once '../../../fns/request_strings.php';
list($text) = request_strings('text');

include_once '../../../fns/str_collapse_spaces_multiline.php';
$text = str_collapse_spaces_multiline($text);
$text = trim($text);

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['notifications/channels/notify/errors'] = $errors;
    redirect("./?id=$id");
}

unset($_SESSION['notifications/channels/notify/errors']);

include_once '../../../fns/Users/Notifications/post.php';
Users\Notifications\post($mysqli, $channel, $text);

$_SESSION['notifications/channels/view/messages'] = [
    'Notification has been posted.',
];

redirect("../view/?id=$id");
