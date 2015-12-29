<?php

namespace Page;

function imageLinkWithDescription ($title,
    $description, $href, $iconName, $options = []) {

    include_once __DIR__.'/../title_and_description.php';
    $content = title_and_description($title, $description);

    include_once __DIR__.'/imageLink.php';
    return imageLink($content, $href, $iconName, $options);

}
