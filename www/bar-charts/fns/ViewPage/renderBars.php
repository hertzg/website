<?php

namespace ViewPage;

function renderBars ($bars, $renderBar) {
    $html = '';
    foreach ($bars as $bar) {
        $value = $bar->value;
        $html .=
            '<div class="barChart-barWrapper">'
                .$renderBar($value)
            .'</div>';
    }
    return $html;
}
