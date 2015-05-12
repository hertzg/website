<?php

namespace ViewPage;

function chartBar ($value, $class, $scale) {
    include_once __DIR__.'/chartValue.php';
    return
        "<div class=\"barChart-bar $class\""
        .' style="height: '.($value * 100 / $scale).'%">'
            .chartValue($value, $class)
        .'</div>';
}
