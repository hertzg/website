<?php

include_once 'lib/require-file.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

unset($_SESSION['files/view_messages']);

$page->base = '../';
$page->title = 'Delete File?';
$page->finish(
    Tab::create(
        Tab::item('Files', create_folder_link($file->idfolders))
        .Tab::activeItem('View'),
        Page::text(
            'Are you sure you want to delete the file'
            .' "<b>'.htmlspecialchars($file->filename).'</b>"?'
        )
        .Page::HR
        .Page::imageLink(
            'Yes, delete file',
            "submit-delete-file.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "view.php?id=$id", 'no')
    )
);
