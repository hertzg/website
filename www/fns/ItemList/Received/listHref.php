<?php

namespace ItemList\Received;

function listHref () {
    include_once __DIR__.'/listUrl.php';
    return htmlspecialchars(listUrl());
}
