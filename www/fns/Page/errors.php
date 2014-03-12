<?php

namespace Page;

function errors (array $texts) {
    include_once __DIR__.'/textList.php';
    return textList($texts, 'errors');
}
