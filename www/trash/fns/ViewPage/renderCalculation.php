<?php

namespace ViewPage;

function renderCalculation ($calculation, &$items) {

    $fnsDir = __DIR__.'/../../../fns';

    $title = $calculation->title;
    if ($title !== '') {
        include_once "$fnsDir/Page/text.php";
        $items[] = \Page\text(htmlspecialchars($title));
    }

    include_once "$fnsDir/Form/label.php";
    $items[] = \Form\label('Expression',
        htmlspecialchars($calculation->expression));

    $tags = $calculation->tags;
    if ($tags !== '') $items[] = \Form\label('Tags', htmlspecialchars($tags));

}
