<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/create_page.php';
include_once '../../../lib/mysqli.php';
$content = create_page($mysqli, $user, $id, '../');

include_once "$fnsDir/Page/confirmDialog.php";
/*
$content .= Page\confirmDialog(
    'Are you sure you want to delete notifications in this channel?',
    'Yes, delete notifications', "submit.php?id=$id", "../?id=$id");
*/
unset($_SESSION['notifications/in-subscribed-channel/messages']);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Delete Notifications?', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
