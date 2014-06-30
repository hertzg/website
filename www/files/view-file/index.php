<?php

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages'],
    $_SESSION['files/rename-file/errors'],
    $_SESSION['files/rename-file/values'],
    $_SESSION['files/send-file/errors'],
    $_SESSION['files/send-file/values']
);

$insert_time = $file->insert_time;
$rename_time = $file->rename_time;
include_once '../../fns/date_ago.php';
$text = '<div>File uploaded '.date_ago($insert_time).'.</div>';
if ($rename_time > $insert_time) {
    $text .= '<div>Last renamed '.date_ago($rename_time).'.</div>';
}
include_once '../../fns/Page/infoText.php';
$infoText = Page\infoText($text);

include_once '../../fns/Page/filePreview.php';
$filePreview = Page\filePreview($file->name, $id, '../download-file/');

include_once 'fns/create_location_bar.php';
include_once 'fns/create_options_panel.php';
include_once '../../fns/bytestr.php';
include_once '../../fns/create_folder_link.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
$content =
    Page\tabs(
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
        .create_location_bar($mysqli, $file)
        .Form\label('File name', $file->name)
        .'<div class="hr"></div>'
        .Form\label('Size', bytestr($file->size))
        .'<div class="hr"></div>'
        .Form\label('Preview', $filePreview)
        .$infoText
    )
    .create_options_panel($file);

include_once '../../fns/echo_page.php';
echo_page($user, "File #$id", $content, '../../');
