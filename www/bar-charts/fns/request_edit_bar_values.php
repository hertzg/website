<?php

function request_edit_bar_values ($bar, $key) {

    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    return [
        'value' => $bar->value,
        'label' => $bar->label,
    ];

}
