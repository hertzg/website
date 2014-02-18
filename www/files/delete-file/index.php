<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id) = require_file($mysqli);

unset($_SESSION['files/view/index_messages']);

include_once '../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = "Delete File #$id?";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Files',
                'href' => create_folder_link($file->idfolders, '../'),
            ),
        ),
        "File #$id",
        Page::text(
            'Are you sure you want to delete the file'
            .' "<b>'.htmlspecialchars($file->filename).'</b>"?'
        )
        .Page::HR
        .Page::imageLink(
            'Yes, delete file',
            "submit.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
