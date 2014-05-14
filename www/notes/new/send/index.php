<?php

include_once 'fns/require_stage.php';
list($user) = require_stage();

$key = 'notes/new/send/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['username' => ''];

include_once '../../../fns/Page/newItemSendForm.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/warnings.php';
include_once '../../../lib/mysqli.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'New',
            'href' => '..',
        ],
    ],
    'Send',
    Page\sessionErrors('notes/new/send/errors')
    .Page\warnings(['Send the new note to:'])
    .Page\newItemSendForm($mysqli, $user->id_users, $values['username'])
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Send New Note', $content, '../../../');
