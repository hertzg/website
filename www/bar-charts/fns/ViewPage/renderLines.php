<?php

namespace ViewPage;

function renderLines ($range, $min, $max, $step) {

    $linesHtml = '';
    $lineLabelsHtml = '';

    $renderLine = function ($value, $class) use ($max,
        $range, &$linesHtml, &$lineLabelsHtml) {

        $top = (($max - $value) * 100 / $range).'%';
        include_once __DIR__.'/../../../fns/short_number.php';
        $linesHtml .= "<div class=\"barChart-line\" style=\"top: $top\"></div>";

        $lineLabelsHtml .=
            "<div class=\"barChart-lineLabel\" style=\"top: $top\">"
                ."<div class=\"barChart-lineLabel-value $class\">"
                    .short_number($value)
                .'</div>'
            .'</div>';

    };

    $html = $renderLine(0, 'positive');
    for ($i = $step; $i < $max; $i += $step) {
        $html .= $renderLine($i, 'positive');
    }
    for ($i = -$step; $i > $min; $i -= $step) {
        $html .= $renderLine($i, 'negative');
    }
    $html .= $renderLine($min, 'negative').$renderLine($max, 'positive');

    return
        '<div class="barChart-lines barChart-verticalPadding">'
            .'<div class="barChart-content">'
                .$linesHtml
            .'</div>'
        .'</div>'
        .'<div class="barChart-lineLabels barChart-verticalPadding">'
            .'<div class="barChart-content">'
                .$lineLabelsHtml
            .'</div>'
            .'<div class="barChart-lineLabels-gradient"></div>'
        .'</div>';

}
