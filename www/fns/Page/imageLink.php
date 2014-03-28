<?php

namespace Page;

function imageLink ($title, $href, $iconName, array $options = []) {
    $content = "<div class=\"image_link-title\">$title</div>";
    include_once __DIR__.'/../create_image_link.php';
    return create_image_link($content, $href, $iconName, $options);
}
