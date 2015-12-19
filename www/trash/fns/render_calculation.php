<?php

function render_calculation ($calculation, &$title, &$icon) {

    $title = $calculation->title;
    if ($title === '') $title = $calculation->expression;
    $title = htmlspecialchars($title);

    $icon = 'calculation';

}
