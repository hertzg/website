<?php

namespace Page;

function tags ($base, $tags) {
    $html =
        '<div class="page-tags">'
            .'<span class="page-tags-label">Tags:</span>';
    foreach ($tags as $tag) {
        $escapedTag = htmlspecialchars($tag);
        $html .=
            "<a class=\"tag\" href=\"$base?tag=$escapedTag\">"
                .$escapedTag
            .'</a>';
    }
    $html .= '</div>';
    return $html;
}
