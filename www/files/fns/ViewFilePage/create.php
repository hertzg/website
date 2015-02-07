<?php

namespace ViewFilePage;

function create ($mysqli, &$user, &$file) {

    include_once __DIR__.'/../require_file.php';
    list($file, $id, $user) = require_file($mysqli);

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/format_author.php";
    $author = format_author($file->insert_time, $file->insert_api_key_name);
    $infoText = "File uploaded $author.";
    if ($file->revision) {
        $author = format_author($file->rename_time, $file->rename_api_key_name);
        $infoText .= "<br />Last renamed $author.";
    }

    $media_type = $file->media_type;

    include_once "$fnsDir/Page/filePreview.php";
    $filePreview = \Page\filePreview($media_type, $file->content_type,
        $id, '../download-file/', '../../', $file->content_revision);

    if ($media_type == 'image') {
        include_once __DIR__.'/imageOptionsPanel.php';
        $imageOptionsPanel = imageOptionsPanel($file);
    } else {
        $imageOptionsPanel = '';
    }

    include_once "$fnsDir/create_folder_link.php";
    $folder_link = create_folder_link($file->id_folders, '../');

    include_once __DIR__.'/locationBar.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Files',
                    'href' => "$folder_link#file_$id",
                ],
            ],
            "File #$id",
            \Page\sessionErrors('files/view-file/errors')
            .\Page\sessionMessages('files/view-file/messages')
            .locationBar($mysqli, $file)
            .\Form\label('File name', htmlspecialchars($file->name))
            .'<div class="hr"></div>'
            .\Form\label('Size', $file->readable_size)
            .'<div class="hr"></div>'
            .\Form\label('Preview', $filePreview)
            .\Page\infoText($infoText)
        )
        .optionsPanel($file)
        .$imageOptionsPanel;

}
