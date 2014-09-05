<?php

function create_text ($note, $base) {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($keyword) = request_strings('keyword');

    include_once __DIR__.'/../../../fns/str_collapse_spaces.php';
    $keyword = str_collapse_spaces($keyword);

    $text = $note->text;

    if ($keyword === '') {
        include_once __DIR__.'/../../../fns/render_external_links.php';
        $content = render_external_links(htmlspecialchars($text), $base);
    } else {
        include_once __DIR__.'/../../../fns/render_match_and_external_links.php';
        $content = render_match_and_external_links($base, $text, $keyword);
    }

    include_once __DIR__.'/../../../fns/Page/text.php';
    return Page\text(nl2br($content));

}
