<?php

function create_page ($receivedFile, $base = '') {

    $id = $receivedFile->id;
    $queryString = "?id=$id";
    $fnsDir = __DIR__.'/../../../../fns';
    $name = $receivedFile->name;

    include_once "$fnsDir/Page/imageLink.php";
    $namePart = rawurlencode(str_replace('/', '_', $name));
    $href = "{$base}download/$id/$namePart";
    $downloadLink = Page\imageLink('Download', $href, 'download');

    $href = "{$base}submit-import.php$queryString";
    $importLink = Page\imageLink('Import', $href, 'import-file');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $title = 'Rename and Import';
    $href = "{$base}rename-and-import/$queryString";
    $renameAndImportLink = Page\imageArrowLink($title, $href, 'import-file');

    if ($receivedFile->archived) {
        $href = "{$base}submit-unarchive.php$queryString";
        $archiveLink = Page\imageLink('Unarchive', $href, 'unarchive');
    } else {
        $href = "{$base}submit-archive.php$queryString";
        $archiveLink = Page\imageLink('Archive', $href, 'archive');
    }

    $href = "{$base}delete/$queryString";
    $deleteLink = Page\imageLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/Page/filePreview.php";
    $filePreview = Page\filePreview($receivedFile->media_type,
        $receivedFile->content_type, $id, "{$base}download/");

    include_once "$fnsDir/bytestr.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/date_ago.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/twoColumns.php";
    return Page\tabs(
        [
            [
                'title' => 'Received',
                'href' => "$base..",
            ],
        ],
        "Received File #$id",
        Page\sessionMessages('files/received/file/messages')
        .Form\label('Received from',
            htmlspecialchars($receivedFile->sender_username))
        .create_panel(
            'The File',
            Form\label('File name', htmlspecialchars($name))
            .'<div class="hr"></div>'
            .Form\label('Size', bytestr($receivedFile->size))
            .'<div class="hr"></div>'
            .Form\label('Preview', $filePreview)
            .Page\infoText(
                'File received '.date_ago($receivedFile->insert_time).'.')
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
