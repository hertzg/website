<?php

namespace ViewFilePage;

function create ($mysqli, &$user, &$file) {

    include_once __DIR__.'/../require_file.php';
    list($file, $id, $user) = require_file($mysqli);

    $fnsDir = __DIR__.'/../../../fns';

    $insert_time = $file->insert_time;
    $rename_time = $file->rename_time;

    include_once "$fnsDir/format_author.php";
    $author = format_author($insert_time, $file->insert_api_key_name);
    $infoText = "File uploaded $author.";
    if ($rename_time != $insert_time) {
        $author = format_author($rename_time, $file->rename_api_key_name);
        $infoText .= "<br />Last renamed $author.";
    }

    include_once "$fnsDir/Page/filePreview.php";
    $filePreview = \Page\filePreview($file->media_type,
        $file->content_type, $id, '../download-file/', '../../');

    include_once __DIR__.'/locationBar.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/bytestr.php";
    include_once "$fnsDir/create_folder_link.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Files',
                    'href' => create_folder_link($file->id_folders, '../'),
                ],
            ],
            "File #$id",
            \Page\sessionMessages('files/view-file/messages')
            .locationBar($mysqli, $file)
            .\Form\label('File name', htmlspecialchars($file->name))
            .'<div class="hr"></div>'
            .\Form\label('Size', bytestr($file->size))
            .'<div class="hr"></div>'
            .\Form\label('Preview', $filePreview)
            .\Page\infoText($infoText)
        )
        .optionsPanel($file);

}
