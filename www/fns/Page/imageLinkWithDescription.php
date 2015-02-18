<?php

namespace Page;

function imageLinkWithDescription ($title,
    $description, $href, $iconName, $options = []) {

    include_once __DIR__.'/../title_and_description.php';
    $content = title_and_description($title, $description);

    include_once __DIR__.'/../create_image_link.php';
    return create_image_link($content, $href, $iconName, $options);

}
