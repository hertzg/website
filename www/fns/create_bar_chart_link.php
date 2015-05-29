<?php

function create_bar_chart_link ($title, $tags, $href, $options = []) {

    $icon = 'bar-chart';

    $descriptions = [];
    if ($tags !== '') {
        $description = 'Tags: '.htmlspecialchars($tags);
        include_once __DIR__.'/Page/imageArrowLinkWithDescription.php';
        return Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);
    }

    include_once __DIR__.'/Page/imageArrowLink.php';
    return Page\imageArrowLink($title, $href, $icon, $options);

}
