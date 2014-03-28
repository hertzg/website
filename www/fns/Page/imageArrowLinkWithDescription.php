<?php

namespace Page;

function imageArrowLinkWithDescription ($title, $description, $href,
    $iconName, array $options = []) {

    $options['class'] = 'withArrow';

    include_once __DIR__.'/imageLinkWithDescription.php';
    return imageLinkWithDescription($title, $description, $href,
        $iconName, $options);

}
