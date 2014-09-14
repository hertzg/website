<?php

namespace Paging;

function prevButton ($offset, $limit, $total, $label, $params = []) {

    $prevOffset = max(0, $offset - $limit);
    if ($prevOffset) $params['offset'] = $prevOffset;

    $href = './?'.htmlspecialchars(http_build_query($params));

    $html = '';
    if ($offset) {
        include_once __DIR__.'/status.php';
        $html .= status($offset, $limit, $total, strtolower($label));
    }
    include_once __DIR__.'/../Page/buttonLink.php';
    $html .= \Page\buttonLink("Show Previous $limit $label", $href);

    return $html;

}
