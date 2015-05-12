<?php

namespace ViewPage;

function chart ($mysqli, $bar_chart) {

    include_once __DIR__.'/../../../fns/Users/BarCharts/Bars/index.php';
    $bars = \Users\BarCharts\Bars\index($mysqli, $bar_chart);

    if (!$bars) return;

    $first_bar = $bars[0];
    $min = $max = $first_bar->value;
    foreach ($bars as $bar) {
        $value = $bar->value;
        if ($value > $max) $max = $value;
        else if ($value < $min) $min = $value;
    }

    $step = 100;
    $n = 0;
    while ($max > $step || $min < -$step) {
        $max /= $step;
        $min /= $step;
        $n++;
    }
    $max = ceil($max);
    $min = floor($min);
    for ($i = 0; $i < $n; $i++) {
        $max *= $step;
        $min *= $step;
    }

    if (!$min && !$max) {
        $max = 1;
        $min = -1;
    }

    include_once __DIR__.'/../../../fns/short_number.php';
    $createBar = function ($value, $class, $scale) {
        return
            "<div class=\"barChart-bar $class\""
            .' style="height: '.($value * 100 / $scale).'%">'
                ."<div class=\"barChart-value $class\">"
                    .short_number($value)
                .'</div>'
            .'</div>';
    };

    $createPositive = function ($value) use ($max, $createBar) {
        return $createBar($value, 'positive', $max);
    };

    $createNegative = function ($value) use ($min, $createBar) {
        return $createBar($value, 'negative', $min);
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

        $renderBar = function ($value) use ($positiveHeight,
            $negativeHeight, $createPositive, $createNegative) {

            if ($value >= 0) {
                return
                    '<div class="barChart-sizer positive"'
                    ." style=\"height: $positiveHeight%\">"
                        .$createPositive($value)
                    .'</div>';
            }

            return
                '<div class="barChart-sizer negative"'
                ." style=\"height: $negativeHeight%\">"
                    .$createNegative($value)
                .'</div>';

        };
    }

    $rulersHtml = '<div class="barChart-rulers">';
    if ($positive) {
        $rulersHtml .=
            "<div class=\"barChart-value positive\">"
                .short_number($max)
            .'</div>';
    }
    if ($negative) {
        $rulersHtml .=
            "<div class=\"barChart-value negative\">"
                .short_number($min)
            .'</div>';
    }
    $rulersHtml .= '</div>';

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
