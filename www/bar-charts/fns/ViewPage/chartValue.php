<?php

namespace ViewPage;

function chartValue ($value, $class) {
    include_once __DIR__.'/../../../fns/short_number.php';
    return
        "<div class=\"barChart-value $class\">"
            .short_number($value)
        .'</div>';
}
