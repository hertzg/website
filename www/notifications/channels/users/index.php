<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['notifications/channels/users/add/errors'],
    $_SESSION['notifications/channels/users/add/values'],
    $_SESSION['notifications/channels/users/messages'],
    $_SESSION['notifications/channels/view/messages']
);

include_once 'fns/create_page.php';
$content = create_page($mysqli, $id);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Channel #$id Users", $content, $base);
