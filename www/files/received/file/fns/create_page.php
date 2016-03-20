<?php

function create_page ($mysqli, $receivedFile, &$scripts, $base = '') {

    $id = $receivedFile->id;
    $name = $receivedFile->name;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $escapedItemQuery = ItemList\Received\escapedItemQuery($id);

    include_once "$fnsDir/ReceivedFiles/ensureSums.php";
    ReceivedFiles\ensureSums($mysqli, $receivedFile);

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../../");

    include_once "$fnsDir/FileName/rawurlencode.php";
    $namePart = FileName\rawurlencode($name);

    include_once "$fnsDir/Page/imageLink.php";
    $downloadLink = Page\imageLink('Download',
        "{$base}download/$id/$namePart", 'download');

    $importLink = Page\imageLink('Import',
        "{$base}submit-import.php$escapedItemQuery", 'import-file');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $renameAndImportLink = Page\imageArrowLink('Rename and Import',
        "{$base}rename-and-import/$escapedItemQuery", 'import-file',
        ['id' => 'rename-and-import']);

    if ($receivedFile->archived) {
        $title = 'Unarchive';
        $href = "{$base}submit-unarchive.php$escapedItemQuery";
        $icon = 'unarchive';
    } else {
        $title = 'Archive';
        $href = "{$base}submit-archive.php$escapedItemQuery";
        $icon = 'archive';
    }
    $archiveLink = Page\imageLink($title, $href, $icon);

    $deleteLink = Page\imageLink('Delete',
        "{$base}delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/ReceivedFiles/File/path.php";
    $path = ReceivedFiles\File\path($receivedFile->receiver_id_users, $id);

    include_once "$fnsDir/Page/filePreview.php";
    $filePreview = Page\filePreview($receivedFile->media_type,
        $receivedFile->content_type, $id, $path,
        "{$base}download/", "$base../../../", $scripts);

    include_once "$fnsDir/export_date_ago.php";
    $date_ago = export_date_ago($receivedFile->insert_time);

    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/create_received_from_item.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    return
        Page\create(
            [
                'title' => 'Files',
                'href' => ItemList\Received\listHref("$base../")."#file_$id",
            ],
            "Received File #$id",
            Page\sessionMessages('files/received/file/messages')
            .create_received_from_item($receivedFile)
        )
        .Page\panel(
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
        .Page\panel(
            'File Options',
            $downloadLink
            .'<div class="hr"></div>'
            .Page\staticTwoColumns($importLink, $renameAndImportLink)
            .'<div class="hr"></div>'
            .Page\twoColumns($archiveLink, $deleteLink)
        );

}
