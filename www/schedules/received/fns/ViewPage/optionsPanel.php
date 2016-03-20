<?php

namespace ViewPage;

function optionsPanel ($user, $receivedSchedule, &$head, &$scripts) {

    $base = '../../../';
    $fnsDir = __DIR__.'/../../../../fns';
    $id = $receivedSchedule->id;

    include_once "$fnsDir/compressed_css_link.php";
    $head .= compressed_css_link('calendarIcon', $base);

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .= compressed_js_script('calendarIcon', $base);

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $itemQuery = \ItemList\Received\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $importLink = \Page\imageLink('Import',
        "../submit-import.php$itemQuery", 'import-schedule');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editAndImportLink = \Page\imageArrowLink('Edit and Import',
        "../edit-and-import/$itemQuery", 'import-schedule',
        ['id' => 'edit-and-import']);

    include_once "$fnsDir/Page/imageLink.php";
    if ($receivedSchedule->archived) {
        $href = "../submit-unarchive.php$itemQuery";
        $archiveLink = \Page\imageLink('Unarchive', $href, 'unarchive');
    } else {
        $href = "../submit-archive.php$itemQuery";
        $archiveLink = \Page\imageLink('Archive', $href, 'archive');
    }

    $deleteLink = \Page\imageLink('Delete',
        "../delete/$itemQuery", 'trash-bin', ['id' => 'delete']);

    include_once __DIR__.'/../../../fns/send_via_sms_link.php';
    include_once "$fnsDir/Page/calendarTodayLink.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\calendarTodayLink($user, "calendar/?id=$id")
        .'<div class="hr"></div>'
        .\Page\twoColumns($importLink, $editAndImportLink)
        .'<div class="hr"></div>'
        .send_via_sms_link($user, $receivedSchedule)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($archiveLink, $deleteLink);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Schedule Options', $content);

}
