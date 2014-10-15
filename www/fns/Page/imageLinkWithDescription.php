<?php

namespace Page;

function imageLinkWithDescription ($title,
    $description, $href, $iconName, $options = []) {

    $content =
        '<div class="title_and_description">'
            ."<div class=\"title_and_description-title\">$title</div>"
            .'<div class="title_and_description-description">'
                .$description
            .'</div>'
        .'</div>';

    include_once __DIR__.'/../create_image_link.php';
    return create_image_link($content, $href, $iconName, $options);

}
