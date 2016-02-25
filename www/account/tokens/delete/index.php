<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_token.php';
include_once '../../../lib/mysqli.php';
list($token, $id, $user) = require_token($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($mysqli, $token, $scripts)
    .Page\confirmDialog(
        'Are you sure you want to delete the remembered session?',
        'Yes, delete remembered session', "submit.php?id=$id",
        "../view/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Remembered Session #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
