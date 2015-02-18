<?php

namespace Page;

function errors ($texts) {
    include_once __DIR__.'/textList.php';
    return textList($texts, 'errors');
}
