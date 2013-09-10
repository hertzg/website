<?php

function render_external_links ($html, $base) {
    return preg_replace_callback('#(http://.*?)(\s|$)#', function ($match) use ($base) {
        $url = html_entity_decode($match[1]);
        $href = htmlspecialchars(create_external_url($url, $base));
        return
            "<a class=\"a\" rel=\"noreferrer\" href=\"$href\">"
                .htmlspecialchars($url)
            .'</a>'
            .$match[2];
    }, $html);
}

include_once 'create_external_url.php';
