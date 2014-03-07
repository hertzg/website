<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../fns/Files/get.php';
include_once '../../lib/mysqli.php';
$file = Files\get($mysqli, $idusers, $id);

if (!$file) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

include_once '../fns/create_folder_link.php';
include_once '../../fns/bytestr.php';
include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/date_ago.php';
include_once '../../fns/Form/label.php';
include_once '../../lib/page.php';

include_once '../../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('files/view-file/index_messages');

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages'],
    $_SESSION['files/rename-file_errors'],
    $_SESSION['files/rename-file_lastpost']
);

$page->base = '../../';
$page->title = "File #$id";
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
        $pageMessages
        .Form\label('File name', $file->filename)
        .'<div class="hr"></div>'
        .Form\label('Size', bytestr($file->filesize))
        .'<div class="hr"></div>'
        .Form\label('Uploaded', date_ago($file->inserttime))
    )
    .create_panel(
        'Options',
        Page::imageLink('Download File',
            "../download-file/?id=$id", 'download')
        .'<div class="hr"></div>'
        .Page::imageArrowLink('Rename File', "../rename-file/?id=$id", 'rename')
        .'<div class="hr"></div>'
        .Page::imageArrowLink('Move File',
            "../move-file/?id=$id&idfolders=$file->idfolders", 'move-file')
        .'<div class="hr"></div>'
        .Page::imageArrowLink('Delete File',
            "../delete-file/?id=$id", 'trash-bin')
    )
);
