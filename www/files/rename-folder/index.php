<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $idfolders) = require_folder($mysqli);

include_once '../fns/create_folder_link.php';
include_once '../../lib/page.php';

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('files/rename-folder_errors');

if (array_key_exists('files/rename-folder_lastpost', $_SESSION)) {
    $values = $_SESSION['files/rename-folder_lastpost'];
} else {
    $values = (array)$folder;
}

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';

$page->base = '../../';
$page->title = "Rename Folder #$idfolders";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Files',
                'href' => create_folder_link($idfolders, '../'),
            ),
        ),
        "Rename Folder #$idfolders",
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\textfield('foldername', 'Folder name', array(
                'value' => $values['foldername'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Rename')
            .Form\hidden('idfolders', $idfolders)
        .'</form>'
    )
);
