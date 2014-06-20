<?php

function create_options_panel ($receivedFolder) {

    $fnsDir = '../../../fns';
    include_once "$fnsDir/Page/imageLink.php";
    $queryString = "?id=$receivedFolder->id";

    $importLink = Page\imageLink('Import', 'submit-import.php', 'import-folder');

    $title = 'Rename and Import';
    $href = "rename-and-import/$queryString";
    $renameAndImportLink = Page\imageLink($title, $href, 'import-folder');

    if ($receivedFolder->archived) {
        $title = 'Unarchive';
        $href = "submit-unarchive.php$queryString";
        $icon = 'unarchive';
    } else {
        $title = 'Archive';
        $href = "submit-archive.php$queryString";
        $icon = 'archive';
    }
    $archiveLink = Page\imageLink($title, $href, $icon);

    $href = "delete/$queryString";
    $deleteLink = Page\imageLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    return create_panel(
        'Folder Options',
        Page\staticTwoColumns($importLink, $renameAndImportLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($archiveLink, $deleteLink)
    );

}
