<?php

include_once 'lib/require-user.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Files.php';
include_once '../classes/Folders.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    $folder = Folders::get($idusers, $idfolders);
    if (!$folder) redirect();
}

$folders = Folders::index($idusers, $idfolders);
$files = Files::index($idusers, $idfolders);

$items = array();

if ($idfolders) {
    $items[] = Page::imageLink(
        '.. Parent folder',
        create_folder_link($folder->parentidfolders),
        'parent-folder'
    );
}

foreach ($folders as $i => $folder) {
    $items[] = Page::imageLink(
        htmlspecialchars($folder->foldername),
        create_folder_link($folder->idfolders),
        'folder'
    );
}

foreach ($files as $i => $file) {
    $items[] = Page::imageLink(
        htmlspecialchars($file->filename),
        "view.php?id=$file->idfiles",
        'file'
    );
}

if (!$folders && !$files) {
    $items[] = Page::info('Folder is empty.');
}

unset(
    $_SESSION['files/add-folder_errors'],
    $_SESSION['files/add-folder_lastpost'],
    $_SESSION['files/rename-folder_errors'],
    $_SESSION['files/upload-files_errors'],
    $_SESSION['files/view_messages'],
    $_SESSION['home_messages']
);

if ($idfolders != ifset($_SESSION['files/index_idfolders'])) {
    unset($_SESSION['files/index_messages']);
}

$folder_options = '';
if ($idfolders) {
    $folder_options =
        Page::HR
        .Page::imageLink('Rename This Folder', "rename-folder.php?idfolders=$idfolders", 'rename')
        .Page::HR
        .Page::imageLink('Move This Folder', "move-folder.php?idfolders=$idfolders", 'move-folder')
        .Page::HR
        .Page::imageLink('Delete This Folder', "delete-folder.php?idfolders=$idfolders", 'trash-bin');
}

$page->base = '../';
$page->title = 'Files';
$page->finish(
    Tab::create(
        Tab::activeItem('Files')
    )
    .Page::messages(ifset($_SESSION['files/index_messages']))
    .join(Page::HR, $items)
    .create_panel(
        'Options',
        Page::imageLink('New Folder', "add-folder.php?parentidfolders=$idfolders", 'create-folder')
        .Page::HR
        .Page::imageLink('Upload Files', "upload-files.php?idfolders=$idfolders", 'upload')
        .$folder_options
    )
);
