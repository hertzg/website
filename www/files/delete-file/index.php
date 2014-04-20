<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

unset($_SESSION['files/view-file/messages']);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
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
    Page\text(
        'Are you sure you want to delete the file'
        .' "<b>'.htmlspecialchars($file->file_name).'</b>"?'
    )
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete file', "submit.php?id=$id", 'yes'),
        Page\imageLink('No, return back', "../view-file/?id=$id", 'no')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, "Delete File #$id?", $content, '../../');
