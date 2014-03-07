<?php

namespace Page;

function imageArrowLink ($title, $href, $iconName,
    array $options = array()) {
    $options['class'] = 'withArrow';
    include_once __DIR__.'/imageLink.php';
    return imageLink($title, $href, $iconName, $options);
}
