<?php

namespace ViewPage;

function renderCalculation ($calculation, &$items) {

    include_once __DIR__.'/../../../fns/Page/text.php';

    $title = $calculation->title;
    if ($title !== '') $items[] = \Page\text(htmlspecialchars($title));
    $items[] = \Page\text(htmlspecialchars($calculation->expression));

    $tags = $calculation->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

}
