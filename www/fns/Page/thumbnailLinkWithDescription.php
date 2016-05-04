<?php

namespace Page;

function thumbnailLinkWithDescription ($title,
    $description, $href, $iconName, $options = []) {

    $content =
        "<span class=\"thumbnail_link-title\">$title</span>"
        .'<span class="zeroHeight"><br class="zeroHeight" /></span>'
        .'<span class="thumbnail_link-description colorText grey">'
            .$description
        .'</span>';

    include_once __DIR__.'/../create_thumbnail_link.php';
    return create_thumbnail_link($content, $href, $iconName, $options);

}
