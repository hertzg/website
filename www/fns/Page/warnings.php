<?php

namespace Page;

function warnings ($texts) {
    include_once __DIR__.'/textList.php';
    return textList($texts, 'warnings');
}
