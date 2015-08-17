<?php

function echo_alert_page ($title, $text, $href, $base) {

    include_once __DIR__.'/compressed_css_link.php';
    $head = compressed_css_link('confirmDialog', $base);

    include_once __DIR__.'/Themes/getDefault.php';
    $theme = Themes\getDefault();

    include_once __DIR__.'/Theme/Brightness/getDefault.php';
    $theme_brightness = Theme\Brightness\getDefault();

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
    echo_html($title, $head, $body, $theme, $theme_brightness, $base);

}
