<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once '../../../fns/request_strings.php';
list($notification_text) = request_strings('notification_text');

include_once '../../../fns/str_collapse_spaces_multiline.php';
$notification_text = str_collapse_spaces_multiline($notification_text);
$notification_text = trim($notification_text);

$errors = [];

if ($notification_text === '') {
    $errors[] = 'Enter notification text.';
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['notifications/channels/notify/errors'] = $errors;
    redirect("./?id=$id");
}

unset($_SESSION['notifications/channels/notify/errors']);

include_once '../../../fns/send_notification.php';
send_notification($mysqli, $channel, $notification_text);

$_SESSION['notifications/channels/view/messages'] = [
    'Notification has been posted.',
];

redirect("../view/?id=$id");
