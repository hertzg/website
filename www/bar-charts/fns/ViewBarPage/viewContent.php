<?php

namespace ViewBarPage;

function viewContent ($bar, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../");

    include_once "$fnsDir/format_author.php";
    $author = format_author($bar->insert_time, $bar->insert_api_key_name);
    $infoText = "Bar created $author.";
    if ($bar->revision) {
        $author = format_author($bar->update_time, $bar->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/Form/label.php";
    $content = \Form\label('Value', $bar->value);

    $label = $bar->label;
    if ($label !== '') {
        $content .=
            '<div class="hr"></div>'
            .\Form\label('Label', htmlspecialchars($label));
    }

    include_once "$fnsDir/Page/infoText.php";
    $content .= \Page\infoText($infoText);

    return $content;

}
