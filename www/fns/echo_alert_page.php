<?php

function echo_alert_page ($title, $text, $href, $base) {

    include_once __DIR__.'/compressed_css_link.php';
    $head = compressed_css_link('confirmDialog', $base);

    include_once __DIR__.'/resolve_theme.php';
    resolve_theme(null, $theme_color, $theme_brightness);

    include_once __DIR__.'/Page/imageLink.php';
    include_once __DIR__.'/Page/text.php';
    $body =
        '<div class="confirmDialog">'
            .'<div class="confirmDialog-aligner"></div>'
            .'<div class="confirmDialog-frame">'
                .Page\text($text)
                .'<div class="hr"></div>'
                .Page\imageLink('Okay', $href, 'yes')
            .'</div>'
        .'</div>';

    include_once __DIR__.'/echo_html.php';
    echo_html($title, $head, $body, $theme_color, $theme_brightness, $base);

}
