<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

$key = 'files/rename-folder/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$folder;

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages'],
    $_SESSION['files/rename-folder/send/errors'],
    $_SESSION['files/rename-folder/send/messages'],
    $_SESSION['files/rename-folder/send/values']
);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/Folders/maxLengths.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Files',
            'href' => create_folder_link($id_folders, '../'),
        ],
    ],
    "Rename Folder #$id_folders",
    Page\sessionErrors('files/rename-folder/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'Folder name', [
            'value' => $values['name'],
            'maxlength' => Folders\maxLengths()['name'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Rename'),
            Form\button('Send', 'sendButton')
        )
        .Form\hidden('id_folders', $id_folders)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Rename Folder #$id_folders", $content, '../../');
