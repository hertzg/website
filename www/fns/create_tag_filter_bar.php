<?php

function create_tag_filter_bar ($tags, $params = []) {
    $html =
        '<div class="textAndButtons">'
            .'<span class="textAndButtons-text">Filter by a tag:</span>';
    include_once __DIR__.'/ColorTag/style.php';
    foreach ($tags as $tag) {
        $tag_name = $tag->tag_name;
        $style = ColorTag\style($tag_name);
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
