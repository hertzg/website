<?php

namespace ViewPage;

function chartBar ($value, $class, $scale) {
    return
        "<div class=\"barChart-bar $class\""
        .' style="height: '.($value * 100 / $scale).'%">'
            ."<div class=\"barChart-value $class\">"
                .'<span class="barChart-number">'
                    .short_number($value)
                .'</span>'
            .'</div>'
        .'</div>';
}
