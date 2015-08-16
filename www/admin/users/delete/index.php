<?php

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id) = require_user($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/create_view_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($user, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the user?',
        'Yes, delete user', "submit.php?id=$id", "../view/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_guest_page.php";
echo_guest_page("Delete User #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
