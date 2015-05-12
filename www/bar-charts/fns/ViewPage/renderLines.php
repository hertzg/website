<?php

namespace ViewPage;

function renderLines ($range, $min, $max) {

    $step = 1;
    $a = 2.5;
    $b = 2;
    while (true) {

        $c = $a;
        $a = $b;
        $b = $c;

        $numLines = $range / $step;
        if ($numLines > 8) $step *= $a;
        elseif ($numLines < 2) $step /= $a;
        else break;

    }

    $round = pow(10, floor(log($step, 10)));
    $step = floor($step / $round) * $round;

    $createLine = function ($value, $class) use ($max, $range) {
        $top = (($max - $value) * 100 / $range).'%';
        include_once __DIR__.'/../../../fns/short_number.php';
        return
            "<div class=\"barChart-line\" style=\"top: $top\">"
                ."<div class=\"barChart-lineValue $class\">"
                    .short_number($value)
                .'</div>'
            .'</div>';
    };

    $html = $createLine(0, 'positive');
    for ($i = $step; $i < $max; $i += $step) {
        $html .= $createLine($i, 'positive');
    }
    for ($i = -$step; $i > $min; $i -= $step) {
        $html .= $createLine($i, 'negative');
    }
    $html .= $createLine($min, 'negative').$createLine($max, 'positive');
    return $html;

}
