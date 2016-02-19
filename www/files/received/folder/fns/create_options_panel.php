<?php

function create_options_panel ($receivedFolder, $base) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $escapedItemQuery = ItemList\Received\escapedItemQuery($receivedFolder->id);

    include_once "$fnsDir/Page/imageLink.php";
    $importLink = Page\imageLink('Import',
        "{$base}submit-import.php$escapedItemQuery", 'import-folder');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $renameAndImportLink = Page\imageArrowLink('Rename and Import',
        "{$base}rename-and-import/$escapedItemQuery", 'import-folder',
        ['id' => 'rename-and-import']);

    if ($receivedFolder->archived) {
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
