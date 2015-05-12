<?php

namespace ViewPage;

function chart ($mysqli, $bar_chart) {

    include_once __DIR__.'/../../../fns/Users/BarCharts/Bars/index.php';
    $bars = \Users\BarCharts\Bars\index($mysqli, $bar_chart);

    if (!$bars) return;

    include_once __DIR__.'/getMinMax.php';
    getMinMax($bars, $min, $max);

    include_once __DIR__.'/chartBar.php';
    $createPositive = function ($value) use ($max) {
        return chartBar($value, 'positive', $max);
    };
    $createNegative = function ($value) use ($min) {
        return chartBar($value, 'negative', $min);
    };

    $range = abs($min) + abs($max);

    if ($max > 0) {
        $positive = true;
        if ($min < 0) {

            $negative = true;

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

            $renderBar = function ($value) use ($positiveHeight,
                $negativeHeight, $createPositive, $createNegative, $createSizer) {

                if ($value >= 0) {
                    return $createSizer($positiveHeight,
                        $createPositive, $value, 'positive');
                }

                return $createSizer($negativeHeight,
                    $createNegative, $value, 'negative');

            };

        } else {
            $negative = false;
            $renderBar = $createPositive;
        }
    } else {
        $positive = false;
        $negative = true;
        $renderBar = $createNegative;
    }

    $createLine = function ($value, $class) use ($max, $range) {
        $top = (($max - $value) * 100 / $range).'%';
        include_once __DIR__.'/../../../fns/short_number.php';
        return
            "<div class=\"barChart-line\" style=\"top: $top\">"
                ."<div class=\"barChart-lineValue $class\">"
                    .'<span class="barChart-number">'
                        .short_number($value)
                    .'</span>'
                .'</div>'
            .'</div>';
    };
    $step = floor($range / 4);
    $linesHtml = $createLine(0, 'positive');
    for ($i = $step; $i < $max; $i += $step) {
        $linesHtml .= $createLine($i, 'positive');
    }
    for ($i = -$step; $i > $min; $i -= $step) {
        $linesHtml .= $createLine($i, 'negative');
    }
    $linesHtml .= $createLine($min, 'negative').$createLine($max, 'positive');

    $barsHtml = '';
    foreach ($bars as $bar) {
        $value = $bar->value;
        $barsHtml .=
            '<div class="barChart-barWrapper">'
                .$renderBar($value)
            .'</div>';
    }

    return
        "<div class=\"barChart\">"
            .'<div class="barChart-content">'
                .$linesHtml.$barsHtml
            .'</div>'
        .'</div>'
        .'<div class="hr"></div>';

}
