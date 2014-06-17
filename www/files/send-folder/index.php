<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

$key = 'files/send-folder/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['username' => ''];

include_once '../../fns/create_folder_link.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Page/itemSendForm.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/warnings.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Files',
            'href' => create_folder_link($folder->id_folders, '../'),
        ],
    ],
    "Send Folder #$id_folders",
    Page\sessionErrors('files/send-folder/errors')
    .Page\warnings(["Send the folder to:"])
    .Page\itemSendForm($mysqli, $user->id_users,
        $values['username'], ['id_folders' => $id_folders])
);

include_once '../../fns/echo_page.php';
echo_page($user, "Send Folder #$id_folders", $content, '../../');
