<?php

function echo_confirm_page ($user, $title, $text,
    $yes_text, $yes_href, $no_text, $no_href, $base) {

    include_once __DIR__.'/compressed_css_link.php';
    $head = compressed_css_link('confirmDialog', $base);

    include_once __DIR__.'/resolve_theme.php';
    resolve_theme($user, $theme_color, $theme_brightness);

    include_once __DIR__.'/Page/imageLink.php';
    include_once __DIR__.'/Page/text.php';
    include_once __DIR__.'/Page/twoColumns.php';
    $body =
        '<div class="confirmDialog">'
            .'<div class="confirmDialog-aligner"></div>'
            .'<div class="confirmDialog-frame">'
                .Page\text($text)
                .'<div class="hr"></div>'
                .Page\twoColumns(
                    Page\imageLink($yes_text, $yes_href, 'yes'),
                    Page\imageLink($no_text, $no_href, 'no')
                )
            .'</div>'
        .'</div>';

    include_once __DIR__.'/echo_html.php';
    echo_html($title, $head, $body, $theme_color, $theme_brightness, $base);

}
