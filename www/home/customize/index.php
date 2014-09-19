<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['home/customize/reorder/messages'],
    $_SESSION['home/customize/show-hide/messages'],
    $_SESSION['home/messages']
);

include_once '../../fns/get_revision.php';
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once 'fns/create_page.php';
$content =
    create_page()
    .'<script type="text/javascript" defer="defer"'
    ." src=\"../../js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once '../../fns/echo_page.php';
echo_page($user, 'Customize Home', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
