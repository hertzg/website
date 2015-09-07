<?php

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/ItemList/escapedPageQuery.php";
$deleteAllHref = 'delete-all/'.ItemList\escapedPageQuery();

include_once 'fns/create_page.php';
include_once '../lib/mysqli.php';
$content = create_page($mysqli, $user);

if ($user->num_schedules) {
    include_once "$fnsDir/delete_all_confirm_dialog.php";
    $content .= delete_all_confirm_dialog($head);
} else {
    $head = '';
}

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Schedules', $content, $base, ['head' => $head]);
