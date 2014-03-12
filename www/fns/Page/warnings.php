<?php

namespace Page;

function warnings (array $texts) {
    include_once __DIR__.'/textList.php';
    return textList($texts, 'warnings');
}
