<?php

$base = '../';
$fnsDir = '../fns';

include_once 'fns/create_page.php';
include_once '../lib/mysqli.php';
$content = create_page($mysqli, $user);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

if ($user->num_deleted_items) {

    $content .=
        '<script type="text/javascript" defer="defer"'
        ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\">"
        .'</script>'
        .'<script type="text/javascript" defer="defer" src="index.js?1">'
        .'</script>';

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('confirmDialog', $base);

} else {
    $head = '';
}

unset($_SESSION['home/messages']);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Trash', $content, $base, [
    'head' => $head,
]);
