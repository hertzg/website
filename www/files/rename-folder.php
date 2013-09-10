<?php

include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

unset($_SESSION['files/index_messages']);

$page->base = '../';
$page->title = 'Rename Folder: '.htmlspecialchars($folder->foldername);
$page->finish(
    Tab::create(
        Tab::item('Home', '../home.php')
        .Tab::item('Files', create_folder_link($idfolders))
        .Tab::activeItem('Rename Folder')
    )
    .Page::errors(ifset($_SESSION['files/rename-folder_errors']))
    .Form::create(
        'submit-rename-folder.php',
        Form::textfield('foldername', 'Folder name', array(
            'value' => $folder->foldername,
            'autofocus' => true,
        ))
        .Page::HR
        .Form::button('Rename')
        .Form::hidden('idfolders', $idfolders)
    )
);
