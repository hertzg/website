<?php

namespace ViewPage;

function renderBars ($bars, $renderBar) {
    $html = '<div class="barChart-bars">';
    foreach ($bars as $bar) {
        $value = $bar->value;
        $html .=
            '<div class="barChart-barWrapper">'
                .$renderBar($value)
            .'</div>';
    }
    $html .= '</div>';
    return $html;
}
