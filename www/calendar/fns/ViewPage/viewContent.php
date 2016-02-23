<?php

namespace ViewPage;

function viewContent ($event, &$head, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../");

    include_once "$fnsDir/format_author.php";
    $author = format_author($event->insert_time, $event->insert_api_key_name);
    $infoText = "Event created $author.";
    if ($event->revision) {
        $api_key_name = $event->update_api_key_name;
        $author = format_author($event->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once __DIR__.'/calendarLink.php';
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/text.php";
    return
        \Page\text(htmlspecialchars($event->text))
        .'<div class="hr"></div>'
        .calendarLink($event, $base, $head)
        .\Page\infoText($infoText);

}
