<?php

$base = '../';
$fnsDir = '../fns';

include_once '../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['home/messages']);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once 'fns/create_page.php';
include_once '../lib/mysqli.php';
$content = create_page($mysqli, $user);

if ($user->num_deleted_items) {
    $content .=
        '<script type="text/javascript" defer="defer"'
        ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\">"
        .'</script>'
        .'<script type="text/javascript" defer="defer" src="index.js">'
        .'</script>';
    $head = '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\">";
} else {
    $head = '';
}

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Trash', $content, $base, [
    'head' => $head,
]);
