<?php

function create_options_panel ($receivedBookmark) {

    $queryString = "?id=$receivedBookmark->id";

    $bookmarksDir = __DIR__.'/../../..';
    $fnsDir = "$bookmarksDir/../fns";

    include_once "$bookmarksDir/fns/create_open_links.php";
    $values = create_open_links($receivedBookmark->url, '../../../');
    list($openLink, $openInNewTabLink) = $values;

    include_once "$fnsDir/Page/imageLink.php";
    $href = "submit-import.php$queryString";
    $importLink = Page\imageLink('Import', $href, 'import-bookmark');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../edit-and-import/$queryString";
    $icon = 'import-bookmark';
    $editAndImportLink = Page\imageArrowLink('Edit and Import', $href, $icon);

    include_once "$fnsDir/Page/imageLink.php";
    if ($receivedBookmark->archived) {
        $archiveLink = Page\imageLink('Unarchive',
            "submit-unarchive.php$queryString", 'unarchive');
    } else {
        $archiveLink = Page\imageLink('Archive',
            "submit-archive.php$queryString", 'archive');
    }

    $href = "../delete/$queryString";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($openLink, $openInNewTabLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Bookmark Options', $content);

}
