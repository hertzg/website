<?php

function create_options_panel ($receivedFolder, $base) {

    $fnsDir = __DIR__.'/../../../../fns';
    $queryString = "?id=$receivedFolder->id";

    include_once "$fnsDir/Page/imageLink.php";
    $href = "{$base}submit-import.php$queryString";
    $importLink = Page\imageLink('Import', $href, 'import-folder');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $title = 'Rename and Import';
    $href = "{$base}rename-and-import/$queryString";
    $renameAndImportLink = Page\imageArrowLink($title, $href, 'import-folder');

    if ($receivedFolder->archived) {
        $title = 'Unarchive';
        $href = "{$base}submit-unarchive.php$queryString";
        $icon = 'unarchive';
    } else {
        $title = 'Archive';
        $href = "{$base}submit-archive.php$queryString";
        $icon = 'archive';
    }
    $archiveLink = Page\imageLink($title, $href, $icon);

    $href = "{$base}delete/$queryString";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageArrowLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    return create_panel(
        'Folder Options',
        Page\twoColumns($importLink, $renameAndImportLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($archiveLink, $deleteLink)
    );

}
