<?php

function create_tag_filter_bar ($tags, $params = []) {
    $html =
        '<div class="textAndButtons">'
            .'<span class="textAndButtons-text">Filter by a tag:</span>';
    foreach ($tags as $tag) {

        $tag_name = $tag->tag_name;

        $hash = md5($tag_name);
        $hue = floor(hexdec(substr($hash, 0, 4)) / 1024 * 360);
        $saturation = 40 + floor(hexdec(substr($hash, 4, 2)) / 255 * 60);
        $luminance = 30 + floor(hexdec(substr($hash, 6, 2)) / 255 * 40);
        $borderColor = "hsl($hue, $saturation%, $luminance%)";
        $saturation -= 20;
        $luminance += 10;
        $backgroundColor = "hsla($hue, $saturation%, $luminance%, 0.5)";

        $style = "border-color: $borderColor;"
            ." background-color: $backgroundColor";

        $params['tag'] = $tag_name;
        $href = '?'.htmlspecialchars(http_build_query($params));
        $html .=
            '<span class="zeroSize"> </span>'
            ."<a class=\"tag\" style=\"$style\" href=\"$href\">"
                .'<span class="tag-text">'
                    .htmlspecialchars($tag_name)
                .'</span>'
                ." <span class=\"tag-number\">($tag->num_items)</span>"
            .'</a>';

    }
    $html .= '</div>';
    return $html;
}
