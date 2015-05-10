<?php

namespace ViewPage;

function chart ($mysqli, $bar_chart) {

    include_once __DIR__.'/../../../fns/Users/BarCharts/Bars/index.php';
    $bars = \Users\BarCharts\Bars\index($mysqli, $bar_chart);

    if ($bars) {

        $first_bar = $bars[0];
        $min = $max = $first_bar->value;
        foreach ($bars as $bar) {
            $value = $bar->value;
            if ($value > $max) $max = $value;
            else if ($value < $min) $min = $value;
        }

        $createBar = function ($value, $class, $scale) {
            return
                "<div class=\"barChart-bar $class\""
                .' style="height: '.($value * 100 / $scale).'%">'
                    ."<div class=\"barChart-value $class\">$value</div>"
                .'</div>';
        };

        $createPositive = function ($value) use ($max, $createBar) {
            return $createBar($value, 'positive', $max);
        };

        $createNegative = function ($value) use ($min, $createBar) {
            return $createBar($value, 'negative', $min);
        };

        if ($min >= 0 && $max >= 0) $renderBar = $createPositive;
        elseif ($min < 0 && $max < 0) $renderBar = $createNegative;
        else {

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

        $barsHtml = '';
        foreach ($bars as $bar) {
            $value = $bar->value;
            $barsHtml .=
                '<div class="barChart-barWrapper">'
                    .$renderBar($value)
                .'</div>';
        }

        return
            '<div class="barChart">'
                .$barsHtml
            .'</div>'
            .'<div class="hr"></div>';

    }

}
