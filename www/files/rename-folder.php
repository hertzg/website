<?php

include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Form.php';
include_once '../lib/page.php';

if (array_key_exists('files/rename-folder_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['files/rename-folder_errors']);
} else {
    $pageErrors = '';
}

if (array_key_exists('files/rename-folder_lastpost', $_SESSION)) {
    $values = $_SESSION['files/rename-folder_lastpost'];
} else {
    $values = (array)$folder;
}

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = "Rename Folder #$idfolders";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => 'Files',
                'href' => create_folder_link($idfolders),
            ],
        ],
        'Rename Folder',
        $pageErrors
        .Form::create(
            'submit-rename-folder.php',
            Form::textfield('foldername', 'Folder name', array(
                'value' => $values['foldername'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::button('Rename')
            .Form::hidden('idfolders', $idfolders)
        )
    )
);
