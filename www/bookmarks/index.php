<?php

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once 'fns/create_page.php';
include_once 'fns/remove_dialog.php';
include_once '../lib/mysqli.php';
$content =
    create_page($mysqli, $user)
    .remove_dialog($user, $head);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Bookmarks', $content, $base, ['head' => $head]);
