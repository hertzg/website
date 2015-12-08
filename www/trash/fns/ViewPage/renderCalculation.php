<?php

namespace ViewPage;

function renderCalculation ($calculation, &$items) {

    include_once __DIR__.'/../../../fns/Page/text.php';

    $title = $calculation->title;
    if ($title !== '') $items[] = \Page\text(htmlspecialchars($title));

    $items[] = \Page\text(htmlspecialchars($calculation->expression));

    $value = $calculation->value;
    if ($value === null) {
        $text =
            '<span class="colorText red">'
                ."Uncomputable expression. $calculation->error"
            .'</span>';
    } else {
        $text = number_format($value, 2);
    }
    $items[] = \Page\text($text);

    $tags = $calculation->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

}
