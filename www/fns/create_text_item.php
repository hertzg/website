<?php

function create_text_item ($text, $base) {

    include_once __DIR__.'/request_strings.php';
    list($keyword) = request_strings('keyword');

    include_once __DIR__.'/parse_keyword.php';
    parse_keyword($keyword, $includes, $excludes);

    if ($keyword === '') {
        include_once __DIR__.'/render_external_links.php';
        $content = render_external_links(htmlspecialchars($text), $base);
    } else {
        include_once __DIR__.'/MatchAndLinks/render.php';
        $content = MatchAndLinks\render($base, $text, $includes);
    }

    include_once __DIR__.'/Page/text.php';
    return Page\text(nl2br($content));

}
