<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['home/customize/messages'],
    $_SESSION['home/customize/reorder/messages']
);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once 'fns/create_page.php';
$content =
    create_page($user)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"../../../js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Customize Home', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
