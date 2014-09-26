<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once '../fns/SearchPage/create.php';
include_once "$fnsDir/delete_all_confirm_dialog.php";
include_once '../../lib/mysqli.php';
$content =
    SearchPage\create($mysqli, $user)
    .delete_all_confirm_dialog($user, $head, '../');

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Bookmarks', $content, $base, ['head' => $head]);
