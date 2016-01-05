<?php

function create_calculation_link ($theme_brightness, $title,
    $value, $tags_json, $href, $options = [], $paint = false) {

    $icon = 'calculation';
    $text_luminance = $theme_brightness === 'light' ? 10 : 90;

    if ($value === null) {
        $description = '<span class="colorText red">Uncomputable</span>';
    } else {
        $description = number_format($value, 2);
    }

    $tags = json_decode($tags_json);
    if ($tags) {

        include_once __DIR__.'/ColorTag/render.php';
        $description .= ' &middot; '
            .ColorTag\render($tags, $text_luminance, $paint);

    }

    include_once __DIR__.'/Page/imageArrowLinkWithDescription.php';
    return Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon, $options);

}
