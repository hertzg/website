<?php

include_once '../fns/require_received_notes.php';
$user = require_received_notes('../');

unset($_SESSION['notes/received/messages']);

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
include_once '../../../lib/mysqli.php';
$content =
    create_page($mysqli, $user, '../')
    .Page\confirmDialog('Are you sure you want to delete'
        .' all the received notes? They will be moved to Trash.',
        'Yes, delete all notes', 'submit.php', '..');

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Delete All Received Notes?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
