<?php

include_once '../fns/require_channel_user.php';
include_once '../../../lib/mysqli.php';
list($channel_user, $id, $user) = require_channel_user($mysqli, '../..');

$content = 'asd';

include_once '../../../fns/echo_page.php';
echo_page($user, "Channel User #$id", $content, '../../../');
