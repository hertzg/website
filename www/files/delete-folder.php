<?php

include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

$page->base = '../';
$page->title = "Delete Folder #$idfolders?";
$page->finish(
    Tab::create(
        Tab::activeItem('Files'),
        Page::text(
            'Are you sure you want to delete the folder'
            .' "<b>'.htmlspecialchars($folder->foldername).'</b>"?'
        )
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
