<?php

namespace Paging;

function prevButton ($offset, $limit,
    $total, $label, $lowercaseLabel, $params = []) {

    $prevOffset = max(0, $offset - $limit);
    if ($prevOffset) $params['offset'] = $prevOffset;
    else unset ($params['offset']);

    if ($params) $href = '?'.htmlspecialchars(http_build_query($params));
    else $href = './';

    $html = '';
    if ($offset) {
        include_once __DIR__.'/status.php';
        $html .= status($offset, $limit, $total, $lowercaseLabel);
    }
    include_once __DIR__.'/../Page/buttonLink.php';
    $html .= \Page\buttonLink("Show Previous $limit $label", $href);

    return $html;

}
