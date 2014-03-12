<?php

function create_tag_filter_bar ($tags, array $params) {
    $html =
        '<div class="tags tagFilterBar">'
            .'<span class="tags-label">Filter by tags:</span>';
    foreach ($tags as $tag) {
        $tagname = $tag->tagname;
        $params['tag'] = $tagname;
        $href = '?'.htmlspecialchars(http_build_query($params));
        $html .=
            "<a class=\"tag\" href=\"$href\">"
                .htmlspecialchars($tagname)
            .'</a>';
    }
    $html .=
        '</div>'
        .'<div class="hr"></div>';
    return $html;
}
