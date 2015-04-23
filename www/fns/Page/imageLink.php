<?php

namespace Page;

function imageLink ($title, $href, $iconName, $options = []) {
    $content = "<span class=\"image_link-title\">$title</span>";
    include_once __DIR__.'/../create_image_link.php';
    return create_image_link($content, $href, $iconName, $options);
}
