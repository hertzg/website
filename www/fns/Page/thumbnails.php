<?php

namespace Page;

function thumbnails ($items) {
    $html = '<div class="thumbnails">';
    foreach ($items as $i => $item) {

        if ($i > 0) {
            if ($i % 2 === 0) {
                $html .= '<span class="hr thumbnails-br n2"></span>';
            }
            if ($i % 3 === 0) {
                $html .= '<span class="hr thumbnails-br n3"></span>';
            }
            if ($i % 4 === 0) {
                $html .= '<span class="hr thumbnails-br n4"></span>';
            }
            if ($i % 5 === 0) {
                $html .= '<span class="hr thumbnails-br n5"></span>';
            }
            if ($i % 6 === 0) {
                $html .= '<span class="hr thumbnails-br n6"></span>';
            }
            if ($i % 7 === 0) {
                $html .= '<span class="hr thumbnails-br n7"></span>';
            }
        }

        $additionalClass = '';
        if ($i % 3 === 1) $additionalClass .= ' wide_of_three';
        if ($i % 6 === 1 || $i % 6 === 4) $additionalClass .= ' narrow_of_six';

        $html .= "<div class=\"thumbnails-item$additionalClass\">$item</div>";

    }
    $html .= '</div>';
    return $html;
}
