<?php

namespace Page;

function tags ($base, $tags) {
    include_once __DIR__.'/../ColorTag/style.php';
    $html =
        '<div class="page-tags">'
            .'<span class="page-tags-label">Tags:</span>';
    foreach ($tags as $tag) {
        $style = \ColorTag\style($tag);
        $href = "$base?tag=".rawurlencode($tag);
        $html .=
            "<a class=\"tag\" style=\"$style\" href=\"$href\">"
                .htmlspecialchars($tag)
            .'</a>';
    }
    $html .= '</div>';
    return $html;
}
