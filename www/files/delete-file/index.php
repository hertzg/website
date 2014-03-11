<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

unset($_SESSION['files/view-file/index_messages']);

include_once '../../fns/create_folder_link.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/text.php';
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
        Page\text(
            'Are you sure you want to delete the file'
            .' "<b>'.htmlspecialchars($file->filename).'</b>"?'
        )
        .'<div class="hr"></div>'
        .Page\imageLink('Yes, delete file', "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', "../view-file/?id=$id", 'no')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Delete File #$id?", $content, '../../');
