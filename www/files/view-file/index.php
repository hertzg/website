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
    $_SESSION['files/idfolders'],
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
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ),
            array(
                'title' => 'Files',
                'href' => create_folder_link($file->idfolders, '../'),
            ),
        ),
        "File #$id",
        Page\sessionMessages('files/view-file/messages')
        .Form\label('File name', $file->filename)
        .'<div class="hr"></div>'
        .Form\label('Size', bytestr($file->filesize))
        .'<div class="hr"></div>'
        .Form\label('Uploaded', date_ago($file->insert_time))
        .'<div class="hr"></div>'
        .Form\label('Preview', create_preview($file))
    )
    .create_options_panel($file);

include_once '../../fns/echo_page.php';
echo_page($user, "File #$id", $content, $base, array(
    'head' => '<link rel="stylesheet" type="text/css" href="index.css?1" />',
));
