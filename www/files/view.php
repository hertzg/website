<?php

include_once 'lib/require-file.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/bytestr.php';
include_once '../fns/create_panel.php';
include_once '../fns/date_ago.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

if (array_key_exists('files/view_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['files/view_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['files/index_messages'],
    $_SESSION['files/rename-file_errors'],
    $_SESSION['files/rename-file_lastpost']
);

$page->base = '../';
$page->title = htmlspecialchars($file->filename);
$page->finish(
    Tab::create(
        Tab::item('Files', create_folder_link($file->idfolders))
        .Tab::activeItem('View'),
        $pageMessages
        .Form::label('File name', $file->filename)
        .Page::HR
        .Form::label('Size', bytestr($file->filesize))
        .Page::HR
        .Form::label('Uploaded', date_ago($file->inserttime))
    )
    .create_panel(
        'Options',
        Page::imageLink('Download File', "download-file.php?id=$id", 'download')
        .Page::HR
        .Page::imageLink('Rename File', "rename-file.php?id=$id", 'rename')
        .Page::HR
        .Page::imageLink(
            'Move File',
            "move-file.php?id=$id&idfolders=$file->idfolders",
            'move-file'
        )
        .Page::HR
        .Page::imageLink('Delete File', "delete-file.php?id=$id", 'trash-bin')
    )
);
