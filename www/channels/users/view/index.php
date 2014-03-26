<?php

include_once '../../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli, '../..');

$content = 'asd';

include_once '../../../fns/echo_page.php';
echo_page($user, 'Add User', $content, '../../../');
