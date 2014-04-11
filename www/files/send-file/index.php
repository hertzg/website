<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

unset($_SESSION['files/view-file/messages']);

$key = 'files/send-file/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = ['username' => ''];
}

include_once '../../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/warnings.php';
$content = create_tabs(
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
    'Send',
    Page\sessionErrors('files/send-file/errors')
    .Page\warnings(["Send the file to:"])
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Zvini username', [
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Send')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Send File #$id", $content, '../../');
