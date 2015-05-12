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

    if ($min >= 0 && $max >= 0) {
        $positive = true;
        $negative = false;
        $class = 'positive';
        $renderBar = $createPositive;
    } elseif ($min < 0 && $max < 0) {
        $negative = true;
        $positive = false;
        $class = 'negative';
        $renderBar = $createNegative;
    } else {

        $positive = $negative = true;
        $class = 'positive negative';

        $totalPercent = (abs($min) + abs($max)) / 100;
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
    }

    $rulersHtml = '<div class="barChart-rulers">';
    include_once __DIR__.'/chartValue.php';
    if ($positive) $rulersHtml .= chartValue($max, 'positive');
    if ($negative) $rulersHtml .= chartValue($min, 'negative');
    $rulersHtml .= '</div>';

    if ($positive) $minEdge = 0;
    else $minEdge = $min;
    if ($negative) $maxEdge = 0;
    else $maxEdge = $max;

    $barsHtml = '';
    foreach ($bars as $bar) {
        $value = $bar->value;
        $barsHtml .=
            '<div class="barChart-barWrapper">'
                .$renderBar($value)
            .'</div>';
    }

    return
        "<div class=\"barChart $class\">$rulersHtml$barsHtml</div>"
        .'<div class="hr"></div>';

}
