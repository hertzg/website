<?php

namespace ItemList\Received;

function listHref ($base = './') {
    include_once __DIR__.'/listUrl.php';
    return htmlspecialchars(listUrl($base));
}
