<?php

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $file) = require_stage($mysqli);

$key = 'files/rename-file/send/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['username' => ''];

include_once '../../../fns/create_folder_link.php';
include_once '../../../fns/Page/itemSendForm.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/warnings.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => create_folder_link($file->id_folders, '../../'),
        ],
        [
            'title' => "File #$id",
            'href' => "../?id=$id",
        ],
    ],
    'Send',
    Page\sessionErrors('files/rename-file/send/errors')
    .Page\warnings(['Send the renamed file to:'])
    .Page\itemSendForm($mysqli, $user->id_users, $values['username'], [
        'id' => $id,
    ])
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Send Renamed File', $content, '../../../');
