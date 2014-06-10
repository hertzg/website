<?php

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

$key = 'contacts/edit/send/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['username' => ''];

include_once '../../../fns/Page/itemSendForm.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/warnings.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => "../../view/?id=$id",
        ],
        [
            'title' => 'Edit',
            'href' => "../?id=$id",
        ],
    ],
    'Send',
    Page\sessionErrors('contacts/edit/send/errors')
    .Page\warnings(['Send the edited contact to:'])
    .Page\itemSendForm($mysqli, $user->id_users, $values['username'], [
        'id' => $id,
    ])
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Send Edited Contact', $content, '../../../');
