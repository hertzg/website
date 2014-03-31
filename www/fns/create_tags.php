<?php

function create_tags ($base, $tags) {
    $html =
        '<div class="page-text tags">'
            .'<span class="tags-label">Tags:</span>';
    foreach ($tags as $tag) {
        $escapedTag = htmlspecialchars($tag->tag_name);
        $html .=
            "<a class=\"tag\" href=\"$base?tag=$escapedTag\">"
                .$escapedTag
            .'</a>';
    }
    $html .= '</div>';
    return $html;
}
