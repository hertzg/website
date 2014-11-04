<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once '../../../fns/request_text.php';
$text = request_text('text');

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

$message = 'Notification has been posted.';
$_SESSION['notifications/channels/view/messages'] = [$message];

redirect("../view/?id=$id");
