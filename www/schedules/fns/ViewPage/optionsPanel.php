<?php

namespace ViewPage;

function optionsPanel ($user, $schedule, &$head, &$scripts) {

    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';
    $id = $schedule->id;

    include_once "$fnsDir/compressed_css_link.php";
    $head .= compressed_css_link('calendarIcon', $base);

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .= compressed_js_script('calendarIcon', $base);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-schedule', ['id' => 'edit']);

    $params = [
        'text' => $schedule->text,
        'interval' => $schedule->interval,
        'offset' => $schedule->offset,
    ];
    $tags = $schedule->tags;
    if ($tags !== '') $params['tags'] = $tags;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-schedule');

    $sendLink = \Page\imageArrowLink('Send',
        "../send/$escapedItemQuery", 'send', ['id' => 'send']);

    $historyLink = \Page\imageArrowLink('History',
        "../history/?id=$id", 'restore-defaults', ['id' => 'history']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = \Page\imageLink('Delete',
        "../delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once __DIR__.'/../send_via_sms_link.php';
    include_once "$fnsDir/create_calendar_icon_today.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        '<a name="calendar"></a>'
        ."<a href=\"calendar/?id=$id\" id=\"calendar\""
        ." class=\"clickable link image_link withArrow localNavigation-link\">"
            .'<span class="image_link-icon">'
                .create_calendar_icon_today($user)
            .'</span>'
            .'<span class="image_link-content">Calendar</span>'
        .'</a>'
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendLink, send_via_sms_link($user, $schedule))
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($historyLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Schedule Options', $content);

}
