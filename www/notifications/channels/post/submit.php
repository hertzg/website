<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once "$fnsDir/request_text.php";
$text = request_text('text');

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notifications/channels/post/errors'] = $errors;
    redirect("./?id=$id");
}

unset($_SESSION['notifications/channels/post/errors']);

include_once "$fnsDir/Users/Notifications/post.php";
Users\Notifications\post($mysqli, $channel, $text);

$message = 'Notification has been posted.';
$_SESSION['notifications/channels/view/messages'] = [$message];

redirect("../view/?id=$id");
