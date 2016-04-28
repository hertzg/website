<?php

namespace ViewPage;

function markedViewContent ($event, &$head, &$scripts, $includes) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/format_author.php";
    $author = format_author($event->insert_time, $event->insert_api_key_name);
    $infoText = "Event created $author.";
    if ($event->revision) {
        $api_key_name = $event->update_api_key_name;
        $author = format_author($event->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/keyword_regex.php";
    $regex = keyword_regex($includes);

    $text = htmlspecialchars($event->text);
    $text = preg_replace($regex, '<mark>$0</mark>', $text);

    include_once __DIR__.'/../../../fns/ViewPage/calendarLink.php';
    include_once "$fnsDir/format_event_time.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/text.php";
    return
        \Page\text($text)
        .'<div class="hr"></div>'
        .calendarLink($event, '../', $head)
        .\Page\infoText($infoText);

}
