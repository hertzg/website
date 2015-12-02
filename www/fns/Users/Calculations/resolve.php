<?php

namespace Users\Calculations;

function resolve ($expression, &$value) {
    include_once __DIR__.'/../../evaluate.php';
    $value = evaluate($expression, $error);
}
