<?php

function render_calculation ($calculation,
    $description, $href, $options, &$items) {

    $title = $calculation->title;
    if ($title === '') $title = $calculation->expression;
    $title = htmlspecialchars($title);

    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, 'calculation', $options);

}
