<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $idfolders, $user) = require_folder($mysqli);

if (array_key_exists('files/rename-folder/values', $_SESSION)) {
    $values = $_SESSION['files/rename-folder/values'];
} else {
    $values = (array)$folder;
}

unset(
    $_SESSION['files/idfolders'],
    $_SESSION['files/messages']
);

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
                'href' => '../../home/',
            ],
            [
                'title' => 'Files',
                'href' => create_folder_link($idfolders, '../'),
            ],
        ],
        "Rename Folder #$idfolders",
        Page\sessionErrors('files/rename-folder/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('foldername', 'Folder name', [
                'value' => $values['foldername'],
                'autofocus' => true,
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\button('Rename')
            .Form\hidden('idfolders', $idfolders)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Rename Folder #$idfolders", $content, '../../');
