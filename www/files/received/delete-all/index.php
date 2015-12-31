<?php

include_once '../fns/require_received_files.php';
$user = require_received_files('../');

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['files/received/errors'],
    $_SESSION['files/received/messages']
);

include_once '../fns/create_page.php';
include_once "$fnsDir/ItemList/Received/listHref.php";
include_once "$fnsDir/Page/confirmDialog.php";
include_once '../../../lib/mysqli.php';
$content =
    create_page($mysqli, $user, $scripts, '../')
    .Page\confirmDialog(
        'Are you sure you want to delete all the received files?'
        .' They will be moved to Trash.', 'Yes, delete all files',
        'submit.php', ItemList\Received\listHref('../'));

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Delete All Received Files?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
