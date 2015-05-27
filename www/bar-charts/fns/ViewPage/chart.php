<?php

namespace ViewPage;

function chart ($mysqli, $bar_chart) {

    include_once __DIR__.'/../../../fns/Users/BarCharts/Bars/index.php';
    $bars = \Users\BarCharts\Bars\index($mysqli, $bar_chart);

    if (!$bars) return;

    include_once __DIR__.'/getMinMax.php';
    getMinMax($bars, $min, $max);

    include_once __DIR__.'/chartBar.php';
    $createPositiveBar = function ($value) use ($max) {
        return chartBar($value, 'positive', $max);
    };
    $createNegativeBar = function ($value) use ($min) {
        return chartBar($value, 'negative', $min);
    };

    $range = abs($min) + abs($max);

    if ($max > 0) {
        if ($min < 0) {

            $totalPercent = $range / 100;
            $positiveHeight = $max / $totalPercent;
            $negativeHeight = -$min / $totalPercent;

            $createSizer = function ($height, $createBar, $value, $class) {
                return
                    "<div class=\"barChart-sizer $class\""
                    ." style=\"height: $height%\">"
                        .$createBar($value)
                    .'</div>';
            };

            $createBar = function ($value) use ($positiveHeight,
                $negativeHeight, $createPositiveBar, $createNegativeBar,
                $createSizer) {

                if ($value >= 0) {
                    return $createSizer($positiveHeight,
                        $createPositiveBar, $value, 'positive');
                }

                return $createSizer($negativeHeight,
                    $createNegativeBar, $value, 'negative');

            };

        } else {
            $createBar = $createPositiveBar;
        }
    } else {
        $createBar = $createNegativeBar;
    }

    include_once __DIR__.'/renderBars.php';
    include_once __DIR__.'/renderLines.php';
    return
        "<div class=\"barChart\">"
            .'<div class="barChart-padding">'
                .'<div class="barChart-content">'
                    .renderLines($range, $min, $max)
                    .renderBars($bars, $createBar)
                .'</div>'
            .'</div>'
        .'</div>'
        .'<div class="hr"></div>';

}
