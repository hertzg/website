<?php

namespace ViewPage;

function renderBars ($bars, $renderBar) {
    $html = '<div class="barChart-bars barChart-verticalPadding">';
    foreach ($bars as $bar) {
        $value = $bar->value;
        $html .=
            '<div class="barChart-barWrapper">'
                .$renderBar($value)
                .'<div class="barChart-label">'
                    .htmlspecialchars($bar->label)
                .'</div>'
            .'</div>';
    }
    $html .= '</div>';
    return $html;
}
