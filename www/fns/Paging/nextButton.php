<?php

namespace Paging;

function nextButton ($offset, $limit, $label, $params = [], $base = '') {
    $params['offset'] = $offset + $limit;
    $href = "$base?".htmlspecialchars(http_build_query($params));
    include_once __DIR__.'/../Page/buttonLink.php';
    return \Page\buttonLink("Show More $label", $href);
}
