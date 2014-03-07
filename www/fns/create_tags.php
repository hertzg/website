<?php

function create_tags ($base, $tags) {
    if ($tags) {
        $html =
            '<div class="hr"></div>'
            .'<div class="page-text tags">'
                .'<span class="tags-label">Tags:</span>';
        foreach ($tags as $tag) {
            $escapedTag = htmlspecialchars($tag->tagname);
            $html .=
                "<a class=\"tag\" href=\"$base?tag=$escapedTag\">"
                    .$escapedTag
                .'</a>';
        }
        $html .= '</div>';
        return $html;
    }
}
