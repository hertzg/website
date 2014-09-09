<?php

function create_tag_filter_bar ($tags, array $params) {
    $html =
        '<div class="page-tags tagFilterBar">'
            .'<span class="label">Filter by a tag:</span>';
    foreach ($tags as $tag) {
        $tag_name = $tag->tag_name;
        $params['tag'] = $tag_name;
        $href = '?'.htmlspecialchars(http_build_query($params));
        $html .=
            "<a class=\"tag\" href=\"$href\">"
                .htmlspecialchars($tag_name)
            .'</a>';
    }
    $html .= '</div>';
    return $html;
}
