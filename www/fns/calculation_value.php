<?php

function calculation_value ($calculation) {
    $value = $calculation->value;
    if ($value === null) {
        return
            '<span class="colorText red">'
                ."Uncomputable expression. $calculation->error"
            .'</span>';
    }
    return number_format($value, 2);
}
