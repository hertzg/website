<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../fns/Files/get.php';
include_once '../../lib/mysqli.php';
$file = Files\get($mysqli, $user->idusers, $id);

if (!$file) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

unset(
    $_SESSION['files/index_idfolders'],
    $_SESSION['files/index_messages'],
    $_SESSION['files/rename-file_errors'],
    $_SESSION['files/rename-file_lastpost']
);

include_once '../fns/create_folder_link.php';
include_once '../../fns/bytestr.php';
include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/date_ago.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
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
        Page\sessionMessages('files/view-file/index_messages')
        .Form\label('File name', $file->filename)
        .'<div class="hr"></div>'
        .Form\label('Size', bytestr($file->filesize))
        .'<div class="hr"></div>'
        .Form\label('Uploaded', date_ago($file->inserttime))
    )
    .create_panel(
        'Options',
        Page\imageLink('Download File',
            "../download-file/?id=$id", 'download')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Rename File', "../rename-file/?id=$id", 'rename')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Move File',
            "../move-file/?id=$id&idfolders=$file->idfolders", 'move-file')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Delete File',
            "../delete-file/?id=$id", 'trash-bin')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "File #$id", $content, $base);
