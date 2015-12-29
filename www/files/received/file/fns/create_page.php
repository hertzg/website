<?php

function create_page ($mysqli, $receivedFile, &$scripts, $base = '') {

    $id = $receivedFile->id;
    $name = $receivedFile->name;
    $queryString = "?id=$id";
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ReceivedFiles/ensureSums.php";
    ReceivedFiles\ensureSums($mysqli, $receivedFile);

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../../");

    include_once "$fnsDir/FileName/rawurlencode.php";
    $namePart = FileName\rawurlencode($name);

    include_once "$fnsDir/Page/imageLink.php";
    $downloadLink = Page\imageLink('Download',
        "{$base}download/$id/$namePart", 'download');

    $href = "{$base}submit-import.php$queryString";
    $importLink = Page\imageLink('Import', $href, 'import-file');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $renameAndImportLink = Page\imageArrowLink('Rename and Import',
        "{$base}rename-and-import/$queryString", 'import-file',
        ['id' => 'rename-and-import']);

    if ($receivedFile->archived) {
        $href = "{$base}submit-unarchive.php$queryString";
        $archiveLink = Page\imageLink('Unarchive', $href, 'unarchive');
    } else {
        $href = "{$base}submit-archive.php$queryString";
        $archiveLink = Page\imageLink('Archive', $href, 'archive');
    }

    $href = "{$base}delete/$queryString";
    $deleteLink = Page\imageLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/ReceivedFiles/File/path.php";
    $path = ReceivedFiles\File\path($receivedFile->receiver_id_users, $id);

    include_once "$fnsDir/Page/filePreview.php";
    $filePreview = Page\filePreview($receivedFile->media_type,
        $receivedFile->content_type, $id, $path,
        "{$base}download/", "$base../../../");

    include_once "$fnsDir/export_date_ago.php";
    $date_ago = export_date_ago($receivedFile->insert_time);

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/create_received_from_item.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    return Page\create(
        [
            'title' => 'Files',
            'href' => "$base../#file_$id",
        ],
        "Received File #$id",
        Page\sessionMessages('files/received/file/messages')
        .create_received_from_item($receivedFile)
        .create_panel(
            'The File',
            Form\label('File name', htmlspecialchars($name))
            .'<div class="hr"></div>'
            .Form\label('Size', $receivedFile->readable_size)
            .'<div class="hr"></div>'
            .Form\label('Preview', $filePreview)
            .'<div class="hr"></div>'
            .Form\label('MD5 sum', $receivedFile->md5_sum)
            .'<div class="hr"></div>'
            .Form\label('SHA-256 sum', $receivedFile->sha256_sum)
            .Page\infoText("File received $date_ago.")
        )
        .create_panel(
            'File Options',
            Page\staticTwoColumns($downloadLink, $importLink)
            .'<div class="hr"></div>'
            .Page\twoColumns($renameAndImportLink, $archiveLink)
            .'<div class="hr"></div>'
            ."<div id=\"deleteLink\">$deleteLink</div>"
        )
    );

}
