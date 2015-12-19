<?php

function calculation_value ($calculation) {

    $value = $calculation->value;
    if ($value === null) {
        include_once __DIR__.'/Page/text.php';
        return Page\text(
            '<span class="colorText red">'
                ."Uncomputable expression. $calculation->error"
            .'</span>'
        );
    }

    include_once __DIR__.'/Form/label.php';
    return Form\label('Value', number_format($value, 2));

}
