<?php

namespace ViewPage;

function renderCalculation ($calculation, &$items) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/text.php";

    $title = $calculation->title;
    if ($title !== '') $items[] = \Page\text(htmlspecialchars($title));

    $items[] = \Page\text(htmlspecialchars($calculation->expression));

    include_once "$fnsDir/calculation_value.php";
    $items[] = \Page\text(calculation_value($calculation));

    $tags = $calculation->tags;
    if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

}
