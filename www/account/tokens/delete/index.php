<?php

include_once '../fns/require_token.php';
include_once '../../../lib/mysqli.php';
list($token, $id, $user) = require_token($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/create_view_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($token)
    .Page\confirmDialog(
        'Are you sure you want to delete the remembered session?',
        'Yes, delete remembered session', "submit.php?id=$id",
        "../view/?id=$id");

include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Remembered Session #$id?", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
