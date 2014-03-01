<?php

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $idfolders) = require_folder($mysqli);

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages']
);

include_once '../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = "Delete Folder #$idfolders?";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Files',
        Page::text(
            'Are you sure you want to delete the folder'
            .' "<b>'.htmlspecialchars($folder->foldername).'</b>"?'
        )
        .Page::HR
        .Page::imageLink('Yes, delete folder',
            "submit.php?idfolders=$idfolders", 'yes')
        .Page::HR
        .Page::imageLink('No, return back',
            create_folder_link($idfolders, '../'), 'no')
    )
);
