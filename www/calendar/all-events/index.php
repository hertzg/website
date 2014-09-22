<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once 'fns/create_page.php';
include_once '../../lib/mysqli.php';
$content =
    create_page($mysqli, $user)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

unset(
    $_SESSION['calendar/errors'],
    $_SESSION['calendar/messages']
);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'All Events', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
