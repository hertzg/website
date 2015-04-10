<?php

namespace ViewPointPage;

function viewContent ($point, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../");

    include_once "$fnsDir/format_author.php";
    $author = format_author($point->insert_time, $point->insert_api_key_name);
    $infoText = "Point created $author.";

    include_once "$fnsDir/Form/label.php";
    $content =
        \Form\label('Latitude', $point->latitude)
        .'<div class="hr"></div>'
        .\Form\label('Longitude', $point->longitude);

    $altitude = $point->altitude;
    if ($altitude !== null) {
        $content .=
            '<div class="hr"></div>'
            .\Form\label('Altitude', $altitude);
    }

    include_once "$fnsDir/Page/infoText.php";
    $content .= \Page\infoText($infoText);

    return $content;

}
