<?php

function render_external_links ($html, $base) {

    include_once __DIR__.'/create_external_url.php';
    $callback = function ($match) use ($base) {
        $url = html_entity_decode($match[1]);
        $href = htmlspecialchars(create_external_url($url, $base));
        return
            "<a class=\"a\" rel=\"noreferrer\" href=\"$href\">"
                .htmlspecialchars($url)
            .'</a>'
            .$match[2];
    };

    return preg_replace_callback('#(http://.*?)(\s|$)#', $callback, $html);

}
