<?php

namespace Timezone;

function isValid ($value) {
    include_once __DIR__.'/index.php';
    return in_array($value, index(), true);
}
