<?php

function render_calculation ($calculation,
    $description, $href, $options, &$items) {

    $title = $calculation->title;
    if ($title === '') $title = htmlspecialchars($calculation->expression);
    else $title = htmlspecialchars($title);

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'calculation', $options);

}
