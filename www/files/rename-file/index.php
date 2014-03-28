<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

if (array_key_exists('files/rename-file/values', $_SESSION)) {
    $values = $_SESSION['files/rename-file/values'];
} else {
    $values = (array)$file;
}

unset($_SESSION['files/view-file/messages']);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => create_folder_link($file->idfolders, '../'),
            ],
            [
                'title' => "File #$id",
                'href' => "../view-file/?id=$id",
            ],
        ],
        'Rename',
        Page\sessionErrors('files/rename-file/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('filename', 'File name', [
                'value' => $values['filename'],
                'autofocus' => true,
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\button('Rename')
            .Form\hidden('id', $id)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Rename File #$id", $content, '../../');
