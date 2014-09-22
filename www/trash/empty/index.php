<?php

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/create_page.php';
include_once '../../lib/mysqli.php';
$content = create_page($mysqli, $user, '../');

include_once "$fnsDir/Page/confirmDialog.php";
$content .= Page\confirmDialog('Are you sure you want to empty the trash?'
    .' All the items in it will be purged.', 'Yes, empty trash',
    'submit.php', '..');

unset(
    $_SESSION['trash/errors'],
    $_SESSION['trash/messages']
);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Empty Trash?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
