<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['trash/errors'],
    $_SESSION['trash/messages']
);

include_once '../fns/create_page.php';
include_once '../../fns/Page/confirmDialog.php';
include_once '../../lib/mysqli.php';
$content =
    create_page($mysqli, $user, '../')
    .Page\confirmDialog('Are you sure you want to empty the trash?'
        .' All the items in it will be purged.', 'Yes, empty trash',
        'submit.php', '..');

include_once '../../fns/echo_page.php';
echo_page($user, 'Empty Trash?', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\">",
]);
