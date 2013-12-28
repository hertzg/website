<?php

include_once 'lib/require-user.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Folders.php';
include_once '../classes/Form.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

list($parentIdFolders) = request_strings('parentidfolders');

if (array_key_exists('files/add-folder_lastpost', $_SESSION)) {
    $values = $_SESSION['files/add-folder_lastpost'];
} else {
    $values = array('foldername' => '');
}

$parentIdFolders = abs((int)$parentIdFolders);
if ($parentIdFolders) {
    $folder = Folders::get($idusers, $parentIdFolders);
    if (!$folder) redirect();
}

if (array_key_exists('files/add-folder_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['files/add-folder_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['files/index_messages']);

$page->base = '../';
$page->title = 'New Folder';
$page->finish(
    Tab::create(
        Tab::item('Files', create_folder_link($parentIdFolders))
        .Tab::activeItem('New Folder'),
        $pageErrors
        .Form::create(
            'submit-add-folder.php',
            Form::textfield('foldername', 'Folder name', array(
                'value' => $values['foldername'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::button('Create')
            .Form::hidden('parentidfolders', $parentIdFolders)
        )
    )
);
