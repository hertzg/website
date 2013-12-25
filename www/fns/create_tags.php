<?php

function create_tags ($tags) {
    if ($tags) {
        $html =
            Page::HR
            .'<div class="page-text tags">'
                .'<span class="tags-label">Tags:</span>';
        foreach ($tags as $tag) {
            $escapedTag = htmlspecialchars($tag->tagname);
            $html .=
                "<a class=\"tag\" href=\"./?tag=$escapedTag\">"
                    .$escapedTag
                .'</a>';
        }
        $html .= '</div>';
        return $html;
    }
}
