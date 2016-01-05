<?php

function render_calculations ($calculations, $total,
    $groupLimit, &$items, $regex, $encodedKeyword) {

    $fnsDir = __DIR__.'/../../fns';

    $num_calculations = count($calculations);
    if ($total > $groupLimit) array_pop($calculations);

    include_once "$fnsDir/create_calculation_link.php";
    foreach ($calculations as $calculation) {

        $title = htmlspecialchars($calculation->title);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $query = "?id=$calculation->id&amp;keyword=$encodedKeyword";
        $href = "../calculations/view/$query";

        $items[] = create_calculation_link($title,
            $calculation->value, $calculation->tags_json, $href);
    }

    if ($num_calculations < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Calculations",
            "../calculations/search/?keyword=$encodedKeyword", 'calculations');
    }

}
