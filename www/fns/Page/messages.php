<?php

namespace Page;

function messages (array $texts) {
    include_once __DIR__.'/textList.php';
    return textList($texts, 'messages');
}
