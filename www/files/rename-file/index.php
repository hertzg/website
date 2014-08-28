<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

$key = 'files/rename-file/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$file;

unset(
    $_SESSION['files/rename-file/send/errors'],
    $_SESSION['files/rename-file/send/messages'],
    $_SESSION['files/rename-file/send/values'],
    $_SESSION['files/view-file/messages']
);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => create_folder_link($file->id_folders, '../'),
        ],
        [
            'title' => "File #$id",
            'href' => "../view-file/?id=$id",
        ],
    ],
    'Rename',
    Page\sessionErrors('files/rename-file/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'File name', [
            'value' => $values['name'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Rename'),
            Form\button('Send', 'sendButton')
        )
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Rename File #$id", $content, '../../');
