<?php

namespace ViewPage;

function markedViewContent ($bar, &$scripts, $includes) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/format_author.php";
    $author = format_author($bar->insert_time, $bar->insert_api_key_name);
    $infoText = "Bar created $author.";
    if ($bar->revision) {
        $author = format_author($bar->update_time, $bar->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/keyword_regex.php";
    $regex = keyword_regex($includes);

    $label = htmlspecialchars($bar->label);
    $label = preg_replace($regex, '<mark>$0</mark>', $label);

    include_once "$fnsDir/Form/label.php";
    $content =
        \Form\label('Value', $bar->value)
        .'<div class="hr"></div>'
        .\Form\label('Label', $label);

    include_once "$fnsDir/Page/infoText.php";
    $content .=
        '<div class="hr"></div>'
        .\Page\infoText($infoText);

    return $content;

}
