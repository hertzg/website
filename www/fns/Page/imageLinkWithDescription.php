<?php

namespace Page;

function imageLinkWithDescription ($title, $description, $href,
    $iconName, array $options = array()) {

    include_once __DIR__.'/../create_title_and_description.php';
    $content = create_title_and_description($title, $description);

    include_once __DIR__.'/../create_image_link.php';
    return create_image_link($content, $href, $iconName, $options);

}
