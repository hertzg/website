<?php

include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

unset($_SESSION['files/index_messages']);

$escapedName = htmlspecialchars($folder->foldername);

$page->base = '../';
$page->title = "Delete Folder: $escapedName";
$page->finish(
    Tab::create(
        Tab::activeItem('Files'),
        Page::text("Are you sure you want to delete the folder \"<b>$escapedName</b>\"?")
        .Page::HR
        .Page::imageLink(
            'Yes, delete folder',
            "submit-delete-folder.php?idfolders=$idfolders",
            'yes'
        )
        .Page::HR
        .Page::imageLink(
            'No, return back',
            create_folder_link($idfolders),
            'no'
        )
    )
);
