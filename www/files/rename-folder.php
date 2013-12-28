<?php

include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
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

unset($_SESSION['files/index_messages']);

$page->base = '../';
$page->title = 'Rename Folder: '.htmlspecialchars($folder->foldername);
$page->finish(
    Tab::create(
        Tab::item('Files', create_folder_link($idfolders))
        .Tab::activeItem('Rename Folder'),
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
