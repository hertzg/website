<?php

namespace SendForm;

function removeDialog ($recipients, $base, &$content, &$head) {

    if (!$recipients) return;

    $fnsDir = __DIR__.'/../';

    include_once "$fnsDir/compressed_js_script.php";
    $content .=
        compressed_js_script('confirmDialog', $base)
        .compressed_js_script('removeRecipient', $base);

    include_once "$fnsDir/compressed_css_link.php";
    $head .= compressed_css_link('confirmDialog', $base);

}
