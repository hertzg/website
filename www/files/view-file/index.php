<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

unset(
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages'],
    $_SESSION['files/rename-file/errors'],
    $_SESSION['files/rename-file/values']
);

include_once 'fns/create_options_panel.php';
include_once 'fns/create_preview.php';
include_once '../../fns/bytestr.php';
include_once '../../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/date_ago.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ],
            [
                'title' => 'Files',
                'href' => create_folder_link($file->id_folders, '../'),
            ],
        ],
        "File #$id",
        Page\sessionMessages('files/view-file/messages')
        .Form\label('File name', $file->file_name)
        .'<div class="hr"></div>'
        .Form\label('Size', bytestr($file->file_size))
        .'<div class="hr"></div>'
        .Form\label('Uploaded', date_ago($file->insert_time))
        .'<div class="hr"></div>'
        .Form\label('Preview', create_preview($file))
    )
    .create_options_panel($file);

include_once '../../fns/echo_page.php';
echo_page($user, "File #$id", $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css" href="index.css?1" />',
]);
