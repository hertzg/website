<?php

function create_text_item ($text, $base) {

    include_once __DIR__.'/request_strings.php';
    list($keyword) = request_strings('keyword');

    include_once __DIR__.'/str_collapse_spaces.php';
    $keyword = str_collapse_spaces($keyword);

    if ($keyword === '') {
        include_once __DIR__.'/render_external_links.php';
        $content = render_external_links(htmlspecialchars($text), $base);
    } else {
        include_once __DIR__.'/MatchAndLinks/render.php';
        $content = MatchAndLinks\render($base, $text, $keyword);
    }

    include_once __DIR__.'/Page/text.php';
    return Page\text(nl2br($content));

}
