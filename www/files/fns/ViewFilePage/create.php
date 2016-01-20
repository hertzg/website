<?php

namespace ViewFilePage;

function create ($mysqli, $file, &$scripts) {

    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';
    $id = $file->id_files;
    $id_folders = $file->id_folders;
    $id_users = $file->id_users;

    include_once "$fnsDir/Files/ensureSums.php";
    \Files\ensureSums($mysqli, $file);

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/format_author.php";
    $author = format_author($file->insert_time, $file->insert_api_key_name);
    $infoText = "File uploaded $author.";
    if ($file->revision) {
        $author = format_author($file->rename_time, $file->rename_api_key_name);
        $infoText .= "<br />Last renamed $author.";
    }

    $media_type = $file->media_type;

    include_once "$fnsDir/Files/File/path.php";
    $path = \Files\File\path($id_users, $id);

    include_once "$fnsDir/Page/filePreview.php";
    $filePreview = \Page\filePreview($media_type, $file->content_type,
        $id, $path, '../download-file/', $base, $file->content_revision);

    if ($media_type == 'image') {
        include_once __DIR__.'/imageOptionsPanel.php';
        $imageOptionsPanel = imageOptionsPanel($file);
    } else {
        $imageOptionsPanel = '';
    }

    unset(
        $_SESSION['files/errors'],
        $_SESSION['files/id_folders'],
        $_SESSION['files/messages'],
        $_SESSION['files/rename-file/errors'],
        $_SESSION['files/rename-file/values'],
        $_SESSION['files/send-file/errors'],
        $_SESSION['files/send-file/messages'],
        $_SESSION['files/send-file/values']
    );

    include_once __DIR__.'/../create_file_location_bar.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Home',
                'href' => '../../home/#files',
            ],
            "File #$id",
            \Page\sessionErrors('files/view-file/errors')
            .\Page\sessionMessages('files/view-file/messages')
            .create_file_location_bar($mysqli,
                "file_$id", $id_folders, $id_users)
            .\Form\label('File name', htmlspecialchars($file->name))
            .'<div class="hr"></div>'
            .\Form\label('Size', $file->readable_size)
            .'<div class="hr"></div>'
            .\Form\label('Preview', $filePreview)
            .'<div class="hr"></div>'
            .\Form\label('MD5 sum', $file->md5_sum)
            .'<div class="hr"></div>'
            .\Form\label('SHA-256 sum', $file->sha256_sum)
            .\Page\infoText($infoText)
        )
        .$imageOptionsPanel
        .optionsPanel($file);

}
