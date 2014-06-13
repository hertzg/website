<?php

function render_bookmark ($bookmark, &$items) {

    include_once __DIR__.'/../../../fns/Page/text.php';

    $title = $bookmark->title;
    if ($title !== '') $items[] = Page\text(htmlspecialchars($title));
    $items[] = Page\text(htmlspecialchars($bookmark->url));

    $tags = $bookmark->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

}
