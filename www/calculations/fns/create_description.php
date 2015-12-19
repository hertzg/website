<?php

function create_description ($calculation) {
    $value = $calculation->value;
    if ($value === null) {
        return '<span class="colorText red">Uncomputable.</span>';
    }
    return number_format($value, 2);
}
