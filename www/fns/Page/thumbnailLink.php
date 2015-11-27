<?php

namespace Page;

function thumbnailLink ($title, $href, $iconName, $options = []) {
    $content = "<span class=\"thumbnail_link-title\">$title</span>";
    include_once __DIR__.'/../create_thumbnail_link.php';
    return create_thumbnail_link($content, $href, $iconName, $options);
}
