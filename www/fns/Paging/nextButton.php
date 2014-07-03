<?php

namespace Paging;

function nextButton ($offset, $limit, $label, array $args = []) {
    $args['offset'] = $offset + $limit;
    $href = './?'.htmlspecialchars(http_build_query($args));
    include_once __DIR__.'/../Page/buttonLink.php';
    return \Page\buttonLink("Show More $label", $href);
}
