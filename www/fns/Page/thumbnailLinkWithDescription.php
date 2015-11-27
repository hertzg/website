<?php

namespace Page;

function thumbnailLinkWithDescription ($title,
    $description, $href, $iconName, $options = []) {

    include_once __DIR__.'/../title_and_description.php';
    $content = title_and_description($title, $description);

    include_once __DIR__.'/../create_thumbnail_link.php';
    return create_thumbnail_link($content, $href, $iconName, $options);

}
